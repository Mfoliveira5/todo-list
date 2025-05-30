<?php
    $tasks = [];

    // Verifica se há tarefas armazenadas na sessão
    session_start();
    if (isset($_SESSION['tasks'])) {
        $tasks = $_SESSION['tasks'];
    }

    // Adiciona nova tarefa ao array
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task'])) {
        $newTask = htmlspecialchars($_POST['task']); // Evita XSS
        $tasks[] = $newTask;
        $_SESSION['tasks'] = $tasks; // Salva as tarefas na sessão
    }

    // Exclui tarefa
    if (isset($_GET['delete'])) {
        $taskId = $_GET['delete'];
        unset($tasks[$taskId]);
        $tasks = array_values($tasks); // Reindexa as tarefas
        $_SESSION['tasks'] = $tasks;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tarefas</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Minha Lista de Tarefas</h1>
        <form method="POST" action="index.php">
            <input type="text" name="task" placeholder="Adicione uma nova tarefa" required>
            <button type="submit">Adicionar</button>
        </form>
        <ul>
            <?php foreach ($tasks as $index => $task): ?>
                <li>
                    <?php echo $task; ?>
                    <a href="index.php?delete=<?php echo $index; ?>">Excluir</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
