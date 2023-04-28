/**
 * Food that snakes eat - it is pulled towards the center of a snake head after
 * it is first touched
 * @param  {Phaser.Game} game game object
 * @param  {Number} x    coordinate
 * @param  {Number} y    coordinate
 */
Gravestone = function (game, x, y) {
    this.game = game;
    this.debug = false;
    this.sprite = this.game.add.sprite(x, y, "gravestone");
    this.sprite.tint = 0xf7ff00;
  
    this.game.physics.p2.enable(this.sprite, this.debug);
    this.sprite.body.clearShapes();
    this.sprite.body.addCircle(this.sprite.width * 0.5);
    //set callback for when something hits the food
    this.sprite.body.onBeginContact.add(this.onBeginContact, this);
  
    this.sprite.gravestone = this;
  
    this.head = null;
    this.constraint = null;
  

  };
  
Gravestone.prototype = {
    onBeginContact: function (phaserBody, p2Body) {
      
    },
    crate: function () {
      
    },
  

    update: function () {
      
    },
    
    destroy: function () {
     
    },

  };
  