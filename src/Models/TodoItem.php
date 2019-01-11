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
        title = :title 
        WHERE id = :id";

        static::$db->query($query);
        static::$db->bind(":title", $title);
        // static::$db->bind(":completed", $completed);
        static::$db->bind(":id", $todoId);
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
    // public static function toggleTodos($completed)
    // {
    //     // TODO: Implement me!
    //     // This is to toggle all todos either as completed or not completed
    // }

    // public static function clearCompletedTodos()
    // {
    //     // TODO: Implement me!
    //     // This is to delete all the completed todos from the database
    // }
}
