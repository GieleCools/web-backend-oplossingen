<?php
	session_start();

	$errorMessage = 'Ahh, damn. Lege todos zijn niet toegestaan...';
	$emptyInput = FALSE;
	$emptyTodo = FALSE;
	$emptyDone = FALSE;

	$_SESSION['countTodos'] = 0;
	$_SESSION['countDones'] = 0;

	$statusKey;
	$statusValue;

	if (!isset($_SESSION['todoItems'])) 
	{
		$emptyTodo = TRUE;
		$emptyDone = TRUE;	
	}
	
	if (isset($_POST['submitTodo']))
	{
		if (isset($_POST['inputTodo']) && $_POST['inputTodo'] != '')
		{
			$arrStatus = array($_POST['inputTodo'] => 'todo');
			$_SESSION['todoItems'][] = $arrStatus;						//Array in array om elk item en hun status(todo/done) te kunnen bewaren
			$emptyInput = FALSE;
		}
		elseif ($_POST['inputTodo'] == '')
		{
			$emptyInput = TRUE;
		}
	}

	if (isset($_POST['toggleTodo'])) 
	{
		foreach ($_SESSION['todoItems'] as $key => $statusArray) 
		{
			if ($key == $_POST['toggleTodo']) 
			{
				$statusKey = key($statusArray);
				$statusValue = $statusArray[$statusKey];

				if ($statusValue === 'todo') 
				{
					$statusArray[key($statusArray)] = 'done';
					$_SESSION['todoItems'][$key] = $statusArray;
				}
				if ($statusValue === 'done') 
				{
					$statusArray[key($statusArray)] = 'todo';
					$_SESSION['todoItems'][$key] = $statusArray;
				}
			}				
		}
	}
	
	if (isset($_POST['deleteTodo'])) 
	{
		unset($_SESSION['todoItems'][$_POST['deleteTodo']]);
	}
	
	if (isset($_SESSION['todoItems'])) 
	{
		foreach ($_SESSION['todoItems'] as $key => $statusArray) 
		{
			if (in_array('todo', $statusArray)) 
			{
				$_SESSION['countTodos']++;
			}
			if (in_array('done', $statusArray)) 
			{
				$_SESSION['countDones']++;
			}
		}
	}


	if ($_SESSION['countTodos'] > 0) 
	{
		$emptyTodo = FALSE;
	}
	if ($_SESSION['countDones'] > 0) 
	{
		$emptyDone = FALSE;
	}
	if ($_SESSION['countTodos'] === 0) 
	{
		$emptyTodo = TRUE;
	}
	if ($_SESSION['countDones'] === 0 ) 
	{
		$emptyDone = TRUE;
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oplossing opdracht 01 Todo - Giele Cools</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<p class="<?= ($emptyInput)? 'error' : '' ?>">
		<?= ($emptyInput)? $errorMessage : '' ?>
	</p>

	<h1>Todo App</h1>
	<?php if ($emptyTodo && $emptyDone): ?>
		<p>Je hebt nog geen TODO's toegevoegd. Zo weinig werk of meesterplanner?</p>	
	<?php endif ?>

	<?php if (!$emptyTodo || !$emptyDone): ?>
		<h2>Nog te doen</h2>
	<?php endif ?>

	<?php if ($emptyTodo && !$emptyDone): ?>
		<p>Schouderklopje, alles is gedaan!</p>
	<?php endif ?>

	<?php if (!$emptyTodo): ?>
		<ul>
			<?php foreach ($_SESSION['todoItems'] as $key => $statusArray): ?>
				<?php foreach ($statusArray as $itemValue => $status): ?>
					<li>
						<?php if ($status == 'todo'): ?>
							<form action="periodeopdracht-01-todo.php" method="post">
								<button name="toggleTodo" value="<?= $key ?>" class="status not-done"><?= $itemValue ?></button>
								<button name="deleteTodo" value="<?= $key ?>"></button>
							</form>
						<?php endif ?>
					</li>
				<?php endforeach ?>
			<?php endforeach; ?>
		</ul>
	<?php endif ?>
	<?php if (!$emptyTodo || !$emptyDone): ?>
		<h2>Done and done!</h2>
	<?php endif ?>
	<?php if (!$emptyDone): ?>
		<ul>
			<?php foreach ($_SESSION['todoItems'] as $key => $statusArray): ?>
				<?php foreach ($statusArray as $itemValue => $status): ?>
					<li>
						<?php if ($status == 'done'): ?>
							<form action="periodeopdracht-01-todo.php" method="post">
								<button name="toggleTodo" value="<?= $key ?>" class="status done"><?= $itemValue ?></button>
								<button name="deleteTodo" value="<?= $key ?>"></button>
							</form>
						<?php endif ?>
					</li>
				<?php endforeach ?>
			<?php endforeach; ?>
		</ul>
	<?php endif ?>

	<?php if (!$emptyTodo && $emptyDone): ?>
			<p>Werk aan de winkel...</p>
	<?php endif ?>

	<h1>Todo toevoegen</h1>
	<form action="periodeopdracht-01-todo.php" method="post">
		<label for="inputTodo">Beschrijving:</label>
		<input type="text" name="inputTodo" id="inputTodo">
		<br/>
		<input type="submit" name="submitTodo" value="Toevoegen" >
	</form>
</body>
</html>