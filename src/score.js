Score = function(game) {
    this.game = game;
    this.score = 0;
    this.text = this.game.add.text(16, 16, 'score: 0', { fontSize: '32px', fill: '#fff' });
};

score.prototype = {
    incrementScore: function(amount) {
        this.score += amount;
        this.scoreText.text = 'Score: ' + this.score;
    }
};
