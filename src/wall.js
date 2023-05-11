/**
 * Food that snakes eat - it is pulled towards the center of a snake head after
 * it is first touched
 * @param  {Phaser.Game} game game object
 * @param  {Number} x    coordinate
 * @param  {Number} y    coordinate
 */
Wall = function (game, x, y) {
  this.game = game;
  this.sprite = this.game.add.sprite(x, y, "wall");
  this.sprite.width = 20;
  this.sprite.height = 20;
  this.game.physics.p2.enable(this.sprite, true);
  this.sprite.body.static = true;
};

Wall.prototype = {
  onBeginContact: function (phaserBody, p2Body) {},
  crate: function () {},

  update: function () {},

  destroy: function () {},
};
