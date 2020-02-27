<?php

// Noteエンティティに関する共通処理を実装する。
//
// $note
//   id          ...メモID。新規作成の場合は空っぽ。
//   title       ...メモのタイトル。必須。255文字以内。
//   content     ...メモの本文。必須。

function makeNoteFromRequest() {
    $note['id'] = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
    $note['title'] = isset($_REQUEST['title']) ? $_REQUEST['title'] : '';
    $note['content'] = isset($_REQUEST['content']) ? $_REQUEST['content'] : '';
    return $note;
}

function emptyError() {
    $error = ['title'=>'', 'content'=>''];
    return $error;
}

function hasError($error) {
    return $error['title'] != '' || $error['content'] != '';
}

function validateNote($note) {
    $error = emptyError();
    if ( $note['title'] == '' ) {
        $error['title'] = 'blank';
    } else if ( mb_strlen($note['title']) > 255 ) {
        $error['title'] = 'length';
    }
    if ( $note['content'] == '' ) {
        $error['content'] = 'blank';
    }
    return $error;
}

function saveNote($pdo, $note) {
    $newNote = $note['id'] == '';
    if ( $newNote ) {
        $sql = "INSERT INTO notes(title, content)"
            ." VALUES(:title, :content)";
    } else {
        $sql = "UPDATE notes"
            ." SET title=:title, content=:content"
            ." WHERE id=:id";
    }
    logI($sql, 'SQL');
    $stmt = $pdo->prepare($sql);
    if ( !$newNote ) {
        $stmt->bindValue(':id', $note['id'], PDO::PARAM_INT);
    }
    $stmt->bindValue(':title', $note['title'], PDO::PARAM_STR);
    $stmt->bindValue(':content', $note['content'], PDO::PARAM_STR);
    $stmt->execute();
    if ( $newNote ) {
        $id = $pdo->lastInsertId();
        $note['id'] = $id;
    }
    return $note;
}

function lookupNote($pdo, $id) {
    $sql = "SELECT id, title, content FROM notes WHERE id=:id";
    logI($sql, 'SQL');
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function findAllNotes($pdo) {
    $sql = "SELECT id, title, content FROM notes ORDER BY title, id";
    logI($sql, 'SQL');
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function removeNote($pdo, $id) {
    $sql = "DELETE FROM notes WHERE id=:id";
    logI($sql, 'SQL');
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}
