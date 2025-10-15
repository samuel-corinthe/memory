<?php
require_once __DIR__ . '/../config/Database.php';

class Score
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

public function save($user_id, $score, $time, $pairs)
{
    $stmt = $this->pdo->prepare("INSERT INTO scores (user_id, score, time, pairs) VALUES (?, ?, ?, ?)");
    return $stmt->execute([$user_id, $score, $time, $pairs]);
}


public function getTop10($pairs = null)
{
    if ($pairs) {
        $stmt = $this->pdo->prepare("
            SELECT s.score, s.time, u.username 
            FROM scores s 
            JOIN users u ON s.user_id = u.id
            WHERE s.pairs = ?
            ORDER BY s.score ASC, s.time ASC
            LIMIT 10
        ");
        $stmt->execute([$pairs]);
    } else {
        $stmt = $this->pdo->query("
        SELECT s.score, s.time, s.pairs, u.username
        FROM scores s
        JOIN users u ON s.user_id = u.id
        ORDER BY s.pairs DESC, s.time ASC, s.score ASC
        LIMIT 10
    ");
    }
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    public function getUserScores($user_id)
    {
        $stmt = $this->pdo->prepare("
            SELECT score, time, created_at
            FROM scores
            WHERE user_id=?
            ORDER BY created_at DESC
        ");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
