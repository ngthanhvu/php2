# Base PHP MVC.

Xin chào, đây là cấu trúc cơ bản của một dự án PHP mvc thuần

## Cách chạy dự án

Chuyển đổi .env.example thành .env

```bash
mv .env.example .env
```

Chạy dự án php với localhost:8000

```bash
php -S localhost:8000
```

Đoạn SQL để chạy với dự án

```bash
CREATE TABLE `posts` (
  `id` int NOT NULL PRIMARY KEY,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL
)
CREATE TABLE `users` (
  `id` int NOT NULL PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `oauth_provider` varchar(255) NOT NULL,
  `oauth_id` varchar(255) NOT NULL
)
```

Cài thư viện Google và Facebook để dùng login with social

```bash
composer require google/apiclient facebook/graph-sdk
```

Cài thư viện PHPMailer

```bash
composer require phpmailer/phpmailer
```
