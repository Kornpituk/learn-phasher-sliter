/**
 * Food that snakes eat - it is pulled towards the center of a snake head after
 * it is first touched
 * @param  {Phaser.Game} game game object
 * @param  {Number} x    coordinate
 * @param  {Number} y    coordinate
 */
Bomb = function (game, x, y) {
  Phaser.Sprite.call(this, game, x, y, "bomb");
  this.game = game;
  this.debug = false;

  this.sprite.tint = 0xffffff;

  this.game.physics.p2.enable(this, this.debug);
  this.body.clearShapes();
  this.body.addCircle(this.width * 0.5);

  this.body.onBeginContact.add(this.onBeginContact, this);
};
Bomb.prototype = {
  /**
   * Call from main update loop
   */
  update: function () {
    //once the food reaches the center of the snake head, destroy it and
    //increment the size of the snake
  },
  /**
   * Destroy this food and its constraints
   */
  destroy: function () {
    this.game.physics.p2.removeBody(this.body);
    this.kill();
  },
};
