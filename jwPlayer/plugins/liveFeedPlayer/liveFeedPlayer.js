(function(jwplayer){

var template = function(player, config, div) {

    function setup(evt) {
        div.style.color = '#F00';
        div.style.padding = '8px';
        if(config.text) {
            div.innerHTML = config.text;
        } else {
            div.innerHTML = ""; //Live Feed
        }
    };
    player.onReady(setup);

    this.resize = function(width, height) {
    };

};

jwplayer().registerPlugin('liveFeedPlayer', '6.0', template);

})(jwplayer);
