Game = function (game) {
};

Game.prototype = {


  preload: function () {
    //load assets
    this.game.load.image("circle", "asset/circle.png");
    this.game.load.image("shadow", "asset/white-shadow.png");
    this.game.load.image("background", "asset/tile-05.png");

    this.game.load.image("eye-white", "asset/eye-white.png");
    this.game.load.image("eye-black", "asset/eye-black.png");

    this.game.load.image("food", "asset/food.png");
    this.game.load.image("think", "asset/think.png");

    this.game.load.image("gravestone", "asset/gravestone.png");
    this.game.load.image("wall-s", "asset/wall-s.png");
  },
  create: function () {
    var width = this.game.width;
    var height = this.game.height;

    this.game.world.setBounds(-width, -height, width * 2, height * 2);
    this.game.stage.backgroundColor = "#444";

    //add tilesprite background
    var background = this.game.add.tileSprite(
      -width,
      -height,
      this.game.world.width,
      this.game.world.height,
      "background"
    );

    //initialize physics and groups
    this.game.physics.startSystem(Phaser.Physics.P2JS);
    this.foodGroup = this.game.add.group();
    this.thinkGroup = this.game.add.group();

    this.snakeHeadCollisionGroup = this.game.physics.p2.createCollisionGroup();
    this.foodCollisionGroup = this.game.physics.p2.createCollisionGroup();
    this.thinkCollisionGroup = this.game.physics.p2.createCollisionGroup();
    this.snakeBHeadCollisionGroup = this.game.physics.p2.createCollisionGroup();

    //add food randomly
    for (var i = 0; i < 500; i++) {
      this.initFood(
        Util.randomInt(-width, width),
        Util.randomInt(-height, height)
      );
    }

    //add food randomly
    for (var i = 0; i < 100; i++) {
      this.initThink(
        Util.randomInt(-width, width),
        Util.randomInt(-height, height)
      );
    }

    this.game.snakes = [];
    this.game.snakesB = [];
    this.game.think = [];

    //create player
    var snake = new PlayerSnake(this.game, "circle", 0, 0, this.nameSnake);
    this.game.camera.follow(snake.head);

    var gravestone = new Gravestone(this.game, "gravestone",200,0);
    console.log(gravestone)

     // ...wall
     this.image = this.add.image(250,350, "wall-s")
     this.image2 = this.add.image(250,650, "wall-s")
    // var wall = new Wall(this.game, "wall-s",150,0);
    // var wall2 = new Wall2(this.game, "wall-s",350,0);
    // var wall3 = new Wall3(this.game, "wall-s",50,0);
    // var wall4 = new Wall4(this.game, "wall-s",90,0);
    // ...

    //create bots
    // new BotSnake(this.game, "circle", -200, 0);
    // new BotSnake(this.game, 'circle', 200, 0);

    //initialize snake groups and collision
    for (var i = 0; i < this.game.snakes.length; i++) {
      var snake = this.game.snakes[i];
      snake.head.body.setCollisionGroup(this.snakeHeadCollisionGroup);
      snake.head.body.collides([this.foodCollisionGroup]);

      snake.head.body.collides([this.thinkCollisionGroup]);
      //callback for when a snake is destroyed
      snake.addDestroyedCallback(this.snakeDestroyed, this);
    }

    //initialize snake groups and collision
    for (var i = 0; i < this.game.snakesB.length; i++) {
      var snakeB = this.game.snakesB[i];
      snakeB.head.body.setCollisionGroup(this.snakeBHeadCollisionGroup);
      snakeB.head.body.collides([this.foodCollisionGroup]);
      snakeB.head.body.collides([this.thinkCollisionGroup]);
      //callback for when a snake is destroyed
      snakeB.addDestroyedCallback(this.snakeBDestroyed, this);
    }
  },
  /**
   * Main update loop
   */
  update: function () {
    //update game components
    for (var i = this.game.snakes.length - 1; i >= 0; i--) {
      this.game.snakes[i].update();
    }
    for (var i = this.game.snakesB.length - 1; i >= 0; i--) {
      this.game.snakesB[i].update();
    }
    for (var i = this.foodGroup.children.length - 1; i >= 0; i--) {
      var f = this.foodGroup.children[i];
      f.food.update();
    }
    for (var i = this.thinkGroup.children.length - 1; i >= 0; i--) {
      var f = this.thinkGroup.children[i];
      f.think.update();
    }

    this.image.rotation += 0.01;
    this.image2.rotation += 0.01;
  },
  /**
   * Create a piece of food at a point
   * @param  {number} x x-coordinate
   * @param  {number} y y-coordinate
   * @return {Food}   food object created
   * @return {Think} think object created
   */
  initFood: function (x, y) {
    var f = new Food(this.game, x, y);
    f.sprite.body.setCollisionGroup(this.foodCollisionGroup);
    this.foodGroup.add(f.sprite);
    f.sprite.body.collides([this.snakeHeadCollisionGroup]);
    return f;
  },
  initThink: function (x, y) {
    var f = new Think(this.game, x, y);
    f.sprite.body.setCollisionGroup(this.thinkCollisionGroup);
    this.thinkGroup.add(f.sprite);
    f.sprite.body.collides([this.snakeHeadCollisionGroup]);
    return f;
  },
  snakeDestroyed: function (snake) {
    // display gravestone
    
    //place food where snake was destroyed
    
    for (
      var i = 0;
      i < snake.headPath.length;
      i += Math.round(snake.headPath.length / snake.snakeLength) * 2
    ) {
      this.initFood(
        snake.headPath[i].x + Util.randomInt(-10, 10),
        snake.headPath[i].y + Util.randomInt(-10, 10)
      );
      var gt = this.add.image(snake.headPath[1].x,snake.headPath[1].y, "gravestone")
    }
    
  },

  // updateScore: function (amount) {
  //   this.score += amount;
  //   this.scoreText.text = "Score: " + this.score;
  // },
};
