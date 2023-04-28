<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Slither.io Clone - Loonride Example</title>
    <script src="lib/phaser.min.js"></script>
    <script src="src/game.js"></script>
    <script src="src/snake.js"></script>
    <script src="src/playerSnake.js"></script>                                             
    <script src="src/botSnake.js"></script>
    <script src="src/eye.js"></script>
    <script src="src/eyePair.js"></script>
    <script src="src/shadow.js"></script>  
    <script src="src/food.js"></script>
    <script src="src/util.js"></script>
    <script src="src/bomb.js"></script>
    <script src="src/enemySnake.js"></script>
    <script src="src/think.js"></script>
    <script src="src/gravestone.js"></script>
</head>
<body>
    <script>
    (function() {
        var game = new Phaser.Game(1900,1000, Phaser.AUTO, null);

        game.state.add('Game', Game);
        game.state.start('Game');
    })();
    </script>
</body>
</html>
