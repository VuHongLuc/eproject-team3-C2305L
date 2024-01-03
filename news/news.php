<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>News Page</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h2 {
            color: #333;
        }
        .article {
            width: 70%; /* Điều chỉnh chiều rộng của các bài viết */
            margin: 0 auto; /* Để căn giữa theo chiều ngang */
            text-align: justify; /* Để căn đều nội dung trong các bài viết */
        }
        img {
            max-width: 100%;
            height: auto;
        }
        
    </style>
</head>
<body>
<?php include '../home/navbar.html'; ?>
<div class="container">
    <h1>News Page</h1>

    <?php
        // Array containing news information
        $news = [
            [
                'title' => 'Learn about USB-C',
                'content' => 'What is USB-C? To solve the problem of cables that are no longer compatible...',
                'image' => 'https://kingstonvietnam.vn/wp-content/uploads/2021/09/usb-kingston-dtmax-256gb-kingstonvietnam.vn-4.jpg',
                'link' => 'news1.php'
            ],
            [
                'title' => 'Should I buy a Kingston USB?',
                'content' => 'Is Kingston USB good or not an issue that many people are concerned about...',
                'image' => 'https://kingstonvietnam.vn/wp-content/uploads/2020/07/ktc-product-usb-dteliteg2-dteg264gb-3-lg.jpg',
                'link' => 'news2.php'
            ],
            [
                'title' => 'How to format an SSD?',
                'content' => 'Have you recently upgraded to a new SSD? Or are you planning to sell or transfer...',
                'image' => 'https://kingstonvietnam.vn/wp-content/uploads/2021/09/ssd-kingston-sxs2000-500gb-kingstonvietnam.vn-6.jpg',
                'link' => 'news3.php'
            ],
            [
                'title' => 'How to set up an IronKey Vault Privacy 80 portable SSD?',
                'content' => 'Need to set up an IronKey Vault Privacy 80 removable SSD? This guide Kingston..',
                'image' => 'https://kingstonvietnam.vn/wp-content/uploads/2022/05/ktc-hero-ssd-ikvp80es-lg-1024x384.jpg',
                'link' => 'news4.php'
            ],
            [
                'title' => 'How to format a USB drive?',
                'content' => 'Oceangate introduces to you How to format a USB drive Formatting...',
                'image' => 'https://kingstonvietnam.vn/wp-content/uploads/2021/09/ssd-kingston-sxs2000-500gb-kingstonvietnam.vn-7.jpg',
                'link' => 'news5.php'
            ],
        ];

        // Display news
        foreach ($news as $article) {
            echo '<div class="article">';
            echo '<h3>' . $article['title'] . '</h3>';
            echo '<img src="' . $article['image'] . '" alt="' . $article['title'] . '">';
            echo '<p>' . $article['content'] . '</p>';
            echo '<a href="' . $article['link'] . '" class="btn btn-danger">Read more</a>';

            echo '</div>';
        }
    ?>
    </div>
    <?php include '../home/footer.html'; ?>
</body>
</html>