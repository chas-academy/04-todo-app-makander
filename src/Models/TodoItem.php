<?php

namespace Todo;

class TodoItem extends Model
{
    const TABLENAME = 'todos'; // This is used by the abstract model, don't touch

    public static function createTodo($title)
    {
        $query = "INSERT INTO " . static::TABLENAME . "(title, created)
            VALUES (:title, now())";
        static::$db->query($query);
        static::$db->bind(":title", $title);
        $result = static::$db->execute();
        

        if (!$result) {
            return;
        };

        return $result;
    }

    public static function updateTodo($todoId, $title, $completed = null)
    {
        $query = "UPDATE ". static::TABLENAME . " SET 
        title = :title,
        completed = :completed
        WHERE id = :id";

        static::$db->query($query);
        static::$db->bind(":id", $todoId);
        static::$db->bind(":title", $title);
        static::$db->bind(":completed", $completed);
        $result = static::$db->execute();

        if (!$result) {
            return;
        };

        return $result;
    }

    public static function deleteTodo($todoId)
    {
        $query = "DELETE FROM " . static::TABLENAME . " WHERE id = :id";
        static::$db->query($query);
        static::$db->bind(":id", $todoId);
        $result = static::$db->execute();

        if (!$result) {
            return;
        };
        return $result;
    }
    
    // (Optional bonus methods below)
    public static function toggleTodos($completed)
    {
        $query = "UPDATE ". static::TABLENAME . " SET 
        completed = :completed";

        static::$db->query($query);
        static::$db->bind(":completed", $completed);
        $result = static::$db->execute();

        if (!$result) {
            return;
        };

        return $result;
    }

    public static function clearCompletedTodos()
    {
        $query = "DELETE FROM " . static::TABLENAME . " WHERE completed = 2";
        static::$db->query($query);

        $result = static::$db->execute();

        if (!$result) {
            return;
        };
        return $result;
    }

    public static function findCompleted()
    {
        try {
            $query = "SELECT * FROM " . static::TABLENAME . " WHERE completed = 2";
            self::$db->query($query);
            $results = self::$db->resultset();

            if (!empty($results)) {
                return $results;
            } else {
                return [];
            }
        } catch (PDOException $err) {
            return $err->getMessage();
        }
    }

    public static function findNotCompleted()
    {
        try {
            $query = "SELECT * FROM " . static::TABLENAME . " WHERE completed = 1";
            self::$db->query($query);
            $results = self::$db->resultset();

            if (!empty($results)) {
                return $results;
            } else {
                return [];
            }
        } catch (PDOException $err) {
            return $err->getMessage();
        }
    }
}
