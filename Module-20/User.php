<?php

	class User {
		private $email;
		private $first_name;
		private $last_name;
		private $age;
        private $link;

		public function __construct($email, $first_name, $last_name, $age)
		{
            $this->connect();
			$this->email = $email;
			$this->first_name = $first_name;
			$this->last_name = $last_name;
			$this->age = $age;
		}

        private function connect()
		{
            $config = require_once 'config.php';
            $dsn = 'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'] . ';charset=' . $config['charset'];
            $this->link = new PDO($dsn, $config['username'], $config['password']);
        }

		public function getColumnNames()
        {
			$getColumnNames = $this->link->prepare("SHOW COLUMNS FROM `users`");
			$getColumnNames->execute();
            return $getColumnNames->fetchAll();
		}

		public function getUsers()
        {
			$getUsers = $this->link->prepare("SELECT * FROM `users`");
			$getUsers->execute();
			return $getUsers->fetchAll();
		}

		public function create()
        {
			$create = $this->link->prepare("INSERT INTO `users` (`id`, `email`,`first_name`, `last_name`, `age`, `date_created`) VALUES (null, :email, :first_name, :last_name, :age, :date_created)");
			$create->execute(['email' => $this->email, 'first_name' => $this->first_name, 'last_name' => $this->last_name, 'age' => $this->age, 'date_created' => (new DateTime())->format('Y-m-d h:i:s')]);
            $_POST = [];
            header('Location: user.php');
		}

		public function update($id)
        {
			$update = $this->link->prepare("UPDATE `users` SET `email` = :email, `first_name` = :first_name, `last_name` = :last_name, `age` = :age WHERE id = $id");
//			$update->execute(['email' => $this->email, 'first_name' => $this->first_name, 'last_name' => $this->last_name, 'age' => $this->age]);
			$update->execute(['email' => 'up@updated.ru', 'first_name' => 'Up', 'last_name' => 'Updated', 'age' =>'33']);
			$_POST = [];
			header('Location: user.php');
		}

		public function delete($id)
        {
			$delete = $this->link->prepare("DELETE FROM `users` WHERE id = $id");
            $delete->execute();
			$_POST = [];
			header('Location: user.php');
		}

        public function truncate()
		{
            $truncate = $this->link->prepare("TRUNCATE TABLE `homework_20`.`users`");
            $truncate->execute();
			$_POST = [];
			header('Location: user.php');
        }

		public function createIvanIvanov42()
		{
			$addNewUser = $this->link->prepare("INSERT INTO `users` (`id`, `email`,`first_name`, `last_name`, `age`, `date_created`) VALUES (null, :email, :first_name, :last_name, :age, :date_created)");
			$addNewUser->execute(['email' => 'ivan@ivanov.ru', 'first_name' => 'Ivan', 'last_name' => 'Ivanov', 'age' => '42', 'date_created' => (new DateTime())->format('Y-m-d h:i:s')]);
			$_POST = [];
			header('Location: user.php');
		}
	}

if (!empty($_POST['create']) AND !empty($_POST['email'])) {
	$user = new User("$_POST[email]", "$_POST[first_name]", "$_POST[last_name]", "$_POST[age]");
    $user->create();
} else {
    $user = new User('', '', '', '');
}

if (!empty($_POST['truncate'])) {
    $user->truncate();
}

if (!empty($_POST['createIvanIvanov42'])) {
	$user->createIvanIvanov42();
}

if (!empty($_POST['deleteId'])) {
    $user->delete($_POST['deleteId']);
}

if (!empty($_POST['updateId'])) {
	$user->update($_POST['updateId']);
}

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Практическая работа №20</title>
</head>
<body>
<h1 class="m-3">Практическая работа №20 Ануфриенок Алексея</h1>
<h4 class="m-3">Таблица всех пользователей:</h4>
<div class="m-3">
    <table class="table table-dark table-striped table-bordered table-sm">
        <thead>
        <tr>
            <?php foreach ($user->getColumnNames() as $array) { ?>
            <th scope="col"><?= $array['Field'];?></th>
            <?php } ?>
            <th>edit</th>
            <th>delete</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($user->getUsers() as $key => $row) { ?>
                <tr>
                    <?php for ($i =0; $i < count($user->getColumnNames()) ; $i++) { ?>
                        <td><?= $row[$i]; ?></td>
                    <?php }	?>
                    <td>
                        <form action="User.php" method="post">
                            <button type="submit" class="btn btn-secondary" name="updateId" value="<?= $row['id'];?>">Edit</button>
                        </form>
                    </td>
                    <td>
                        <form action="User.php" method="post">
                            <button type="submit" class="btn btn-danger" name="deleteId" value="<?= $row['id'];?>">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<div class="m-3">
    <h4>Форма добавления нового пользователя:</h4>
</div>
<form class="form-floating" action="User.php" method="post">
    <div class="m-3">
        <label for="email" class="form-label">Введите email (обязательно для заполнения)</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com*">
    </div>
    <div class="m-3">
        <label for="first_name" class="form-label">Введите имя</label>
        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Алексей">
    </div>
    <div class="m-3">
        <label for="last_name" class="form-label">Введите фамилию</label>
        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Ануфриенок">
    </div>
    <div class="m-3">
        <label for="age" class="form-label">Введите возраст</label>
        <input type="number" class="form-control" id="age" name="age" placeholder="35" min="0" max="150">
    </div>
    <div class="m-3">
        <input class="btn btn-primary" type="submit" name="create" value="Сохранить пользователя" />
    </div>
</form>
<div class="m-3">
    <h4>Бонусы для проверки:</h4>
</div>
<form action="User.php" method="post">
    <div class="m-3">
        <input class="btn btn-danger" type="submit" name="truncate" value="Очистить таблицу (команда TRUNCATE)" />
    </div>
    <div class="m-3">
        <input class="btn btn-info" type="submit" name="createIvanIvanov42" value="Создать ivan@ivanov.ru Иван Иванов 42 года" />
    </div>
</form>
</body>
</html>