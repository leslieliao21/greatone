(function (lib, img, cjs, ss, an) {

var p; // shortcut to reference prototypes
lib.ssMetadata = [];


// symbols:



(lib.Path = function() {
	this.initialize(img.Path);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,36,36);


(lib.light = function() {
	this.initialize(img.light);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,983,878);


(lib.light2 = function() {
	this.initialize(img.light2);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,960,534);// helper functions:

function mc_symbol_clone() {
	var clone = this._cloneProps(new this.constructor(this.mode, this.startPosition, this.loop));
	clone.gotoAndStop(this.currentFrame);
	clone.paused = this.paused;
	clone.framerate = this.framerate;
	return clone;
}

function getMCSymbolPrototype(symbol, nominalBounds, frameBounds) {
	var prototype = cjs.extend(symbol, cjs.MovieClip);
	prototype.clone = mc_symbol_clone;
	prototype.nominalBounds = nominalBounds;
	prototype.frameBounds = frameBounds;
	return prototype;
	}


(lib.flicker = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層 1
	this.instance = new lib.Path();
	this.instance.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.flicker, new cjs.Rectangle(0,0,36,36), null);


(lib.元件2 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層 1
	this.instance = new lib.light();
	this.instance.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.元件2, new cjs.Rectangle(0,0,983,878), null);


(lib.元件1 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層 1
	this.instance = new lib.light2();
	this.instance.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.元件1, new cjs.Rectangle(0,0,960,534), null);


(lib.lightspot_move = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層 1
	this.instance = new lib.flicker();
	this.instance.parent = this;
	this.instance.setTransform(-2,-1.4,1,1,0,0,0,18,18);
	this.instance.alpha = 0.488;

	this.timeline.addTween(cjs.Tween.get(this.instance).to({alpha:1},8,cjs.Ease.get(1)).to({alpha:0.5},8).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-20,-19.4,36,36);


(lib.lightspot = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層 10 複製
	this.instance = new lib.lightspot_move();
	this.instance.parent = this;
	this.instance.setTransform(15.9,-112.1,0.8,0.8,-142.6,0,0,-2,-1.4);
	this.instance.alpha = 0;

	this.timeline.addTween(cjs.Tween.get(this.instance).to({guide:{path:[15.9,-112.1,5.6,-104.8,-2.6,-92.3,-11.2,-79.3,-13,-65.7]},alpha:1},9).to({regY:-1.5,guide:{path:[-13.1,-65.6,-15.2,-49.4,-7.9,-32.1,8.1,5.7,23.8,25.8,39.2,45.5,69,67,83.8,77.6,88.1,98.9,92.4,120.1,83.9,139.5,74.6,160.9,53.2,170.1,28.4,180.8,-7.4,172.2,-71.3,156.9,-80.5,111.5,-83.4,97.3,-80.4,81.7,-79.4,76.8,-78,72.3,-77,69.2,-76.7,68.7,-68.8,56.2,-66.3,40.1,-61.2,7.8,-86.5,-12.6,-101.3,-24.6,-123.8,-26.1,-145.2,-27.4,-166.2,-19.2,-175.8,-15.4,-183.7,-10.2]}},110).to({guide:{path:[-183.7,-10.3,-193.4,-3.9,-200.5,4.7,-214,21,-213.8,41]},alpha:0},10).wait(1));

	// 圖層 10
	this.instance_1 = new lib.lightspot_move();
	this.instance_1.parent = this;
	this.instance_1.setTransform(47,137.9,1,1,0,0,0,-2,-1.5);
	this.instance_1.alpha = 0;

	this.timeline.addTween(cjs.Tween.get(this.instance_1).to({guide:{path:[46.9,137.9,50.7,125.9,49.7,110.8,48.6,95.4,41.8,83.4]},alpha:1},9).to({guide:{path:[41.7,83.4,33.6,69.2,17.3,60,-18.3,39.7,-43,33.2,-67.1,27,-104,28,-122.2,28.5,-138.5,14.2,-154.8,0,-159.9,-20.4,-165.5,-43.1,-154.1,-63.5,-141,-87,-107.3,-102,-47.2,-128.7,-12.3,-98.2,-1.4,-88.7,5.7,-74.5,7.9,-70,9.5,-65.6,10.6,-62.5,10.6,-62,12,-47.3,19.8,-32.9,35.4,-4.2,68,-3.4,86.9,-2.9,105.7,-15.4,123.5,-27.2,135.2,-46.5,140.5,-55.4,143.6,-64.3]}},110).to({guide:{path:[143.6,-64.3,147.5,-75.3,147.9,-86.4,148.6,-107.6,136.3,-123.4]},alpha:0},10).wait(1));

	// 圖層 8
	this.instance_2 = new lib.lightspot_move();
	this.instance_2.parent = this;
	this.instance_2.setTransform(-12.4,134.8,0.5,0.5,0,0,0,-2,-1.4);
	this.instance_2.alpha = 0;

	this.timeline.addTween(cjs.Tween.get(this.instance_2).to({regX:-2.1,guide:{path:[-12.4,134.9,-16.7,135.5,-22.7,135.7,-36.9,136,-48.4,132,-66.2,126,-74.3,111.3]},alpha:1},9).to({regX:-2,guide:{path:[-74.3,111.2,-83.1,95.5,-80.7,69.9,-79.6,58.2,-77.6,41.1,-76.6,31.8,-75.3,20.8,-72.5,-2.5,-72,-12.3,-71.4,-26.5,-73.8,-36.8,-76.3,-47.8,-83.4,-60,-90.3,-72.1,-105.3,-76.4,-119.5,-80.5,-135.5,-76.4,-152,-72.1,-163.4,-60.8,-176.1,-48.3,-178.7,-30.7,-183.8,4.4,-161.7,26.3,-151.9,36,-138.4,41.1,-125.2,46.1,-110.7,45.9,-97.6,45.7,-77.6,41.1,-76,40.7,-74.3,40.3,-52.4,34.9,-29.7,26.2,-5.6,17,12.4,6.6,32.4,-4.7,41.2,-15.4,45.3,-22.4,52.3,-32.5,66.1,-52.6,80.2,-67.7,125.2,-116.1,155.2,-96,172.5,-84.5,179.5,-56.7,186,-31,182,-0.7,180.8,8.4,178.8,16.8]}},110).to({guide:{path:[178.9,17,174.2,36.1,165.4,50.7,152.4,72.1,134.5,76.1]},alpha:0},10).wait(1));

	// lightspot_move 複製
	this.instance_3 = new lib.lightspot_move();
	this.instance_3.parent = this;
	this.instance_3.setTransform(104.2,-109.7,1,1,117.5,0,0,-2,-2);
	this.instance_3.alpha = 0;
	this.instance_3._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_3).wait(13).to({_off:false},0).to({guide:{path:[104.3,-109.6,93.5,-120.5,79.7,-131.2,66.3,-141.5,54.4,-147.3]},alpha:1},9).to({guide:{path:[54.5,-147.2,39.6,-154.4,27.2,-154.7,-20.6,-155.5,-41,-101.5,-45,-90.9,-42.7,-70,-41.1,-55.5,-35.1,-28.1,-27.4,6.8,-25.7,16.3,-21.4,40.8,-22.2,55.5,-23.1,72,-30.1,84.9,-36.6,97,-47,104.1,-57.1,111,-68.5,111.5,-80.2,112.1,-90.3,105.8,-100.4,99.3,-109.8,88.6,-119.2,77.9,-125.7,65.4,-140.3,36.8,-133.5,15.6,-133.3,15,-133.2,14.4]}},70).to({guide:{path:[-133.2,14.5,-126.6,-5.9,-116.3,-21.4,-107,-35,-95.9,-43.3]},alpha:0},10).to({_off:true},1).wait(27));

	// 圖層 5   複製 2
	this.instance_4 = new lib.lightspot_move();
	this.instance_4.parent = this;
	this.instance_4.setTransform(-110.1,155.9,1,1,-138.3,0,0,-2,-1.5);
	this.instance_4.alpha = 0;
	this.instance_4._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_4).wait(30).to({_off:false},0).to({regY:-1.6,guide:{path:[-110,155.9,-98.5,157.7,-83.2,156.4,-75,155.6,-67.4,153.9]},alpha:1},9).to({regY:-1.4,guide:{path:[-67.3,154,-43.7,148.7,-26.3,133.9,-16.7,125.8,-10.7,111.2,-5.3,98.2,-3.5,82,-1.7,66.9,-3.3,53.1,-4.7,39.3,-9,31.6,-13.5,23.1,-15,8.5,-16.6,-7.6,-13.3,-23.4,-9.5,-41.8,0.4,-54.9,11.8,-70.3,30.4,-76.9,55.4,-85.7,77.9,-86.9]}},70).to({guide:{path:[77.9,-86.9,86.3,-87.3,94.3,-86.6,109.8,-85.4,124.6,-79.7]},alpha:0},10).to({_off:true},1).wait(10));

	// 圖層 5 複製
	this.instance_5 = new lib.lightspot_move();
	this.instance_5.parent = this;
	this.instance_5.setTransform(2,195.8,1,1,163.8,0,0,-2.1,-1.5);
	this.instance_5.alpha = 0;
	this.instance_5._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_5).wait(40).to({_off:false},0).to({regX:-2,guide:{path:[2.1,195.8,9.7,187,16.6,173.4,20.3,166,22.9,158.7]},alpha:1},9).to({guide:{path:[23,158.6,31.1,135.8,27.7,113.1,25.9,100.8,16.8,88,8.6,76.5,-4.2,66.3,-16,56.8,-28.5,50.8,-41,44.8,-49.7,44.2,-59.3,43.6,-72.5,37,-87.1,29.9,-98.7,18.8,-112.2,5.9,-118.2,-9.5,-125.1,-27.4,-120.8,-46.8,-115,-72.6,-104,-92.3]}},70).to({guide:{path:[-104,-92.3,-99.9,-99.6,-95.1,-106.1,-85.9,-118.6,-73.2,-128.1]},alpha:0},10).wait(1));

	// 圖層 5
	this.instance_6 = new lib.lightspot_move();
	this.instance_6.parent = this;
	this.instance_6.setTransform(9.2,-172.8,0.5,0.5,0,0,0,-2,-1.5);
	this.instance_6.alpha = 0;
	this.instance_6._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_6).wait(5).to({_off:false},0).to({regX:-2.1,guide:{path:[9.2,-172.7,-0.6,-166.4,-11,-155.2,-16.7,-149.2,-21.3,-142.9]},alpha:1},9).to({regX:-2,regY:-1.4,guide:{path:[-21.3,-142.9,-35.4,-123.2,-38.5,-100.6,-40.2,-88.2,-35,-73.4,-30.4,-60.1,-21,-46.7,-12.3,-34.3,-1.9,-25,8.3,-15.7,16.6,-12.7,25.6,-9.4,36.4,0.5,48.4,11.5,56.4,25.4,65.8,41.6,67.2,58,68.8,77.2,59.3,94.5,46.5,117.7,30.5,133.5]}},70).to({regX:-2.1,guide:{path:[30.4,133.6,24.5,139.5,18,144.3,5.7,153.7,-9.1,159.3]},alpha:0},10).to({_off:true},1).wait(35));

	// lightspot_move
	this.instance_7 = new lib.lightspot_move();
	this.instance_7.parent = this;
	this.instance_7.setTransform(-148.9,-110.5,1,1,0,0,0,-2,-2);
	this.instance_7.alpha = 0;

	this.timeline.addTween(cjs.Tween.get(this.instance_7).to({guide:{path:[-148.9,-110.5,-153.5,-96,-156.6,-78.8,-159.5,-62.1,-159.2,-49]},alpha:1},9).to({guide:{path:[-159.2,-48.9,-158.8,-32.4,-153.3,-21.3,-131.9,21.4,-74.6,14.6,-63.3,13.3,-45.9,1.6,-33.8,-6.5,-12.3,-24.4,15.2,-47.4,22.8,-53.3,42.5,-68.5,56,-74.6,71,-81.3,85.7,-81.1,99.4,-80.9,110.5,-74.9,121.3,-69.1,127.1,-59.2,133,-49.1,132,-37.3,131,-25.3,125.8,-12.1,120.7,1.1,112.5,12.7,94,38.8,72,42.7,71.4,42.8,70.8,42.9]}},70).to({guide:{path:[70.9,42.9,49.7,46.4,31.3,44.4,15,42.5,2.4,36.5]},alpha:0},10).to({_off:true},1).wait(40));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-167,-132.2,232,288.1);


(lib.light2_1 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層 1
	this.instance = new lib.元件1();
	this.instance.parent = this;
	this.instance.setTransform(422,-5.1,0.8,0.8,0,0,0,422,-5.2);
	this.instance.alpha = 0.391;

	this.timeline.addTween(cjs.Tween.get(this.instance).to({regY:-5.1,scaleX:1,scaleY:1,alpha:1},14,cjs.Ease.get(1)).to({regY:-5.2,scaleX:0.8,scaleY:0.8,alpha:0.391},15).wait(7));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(84.4,-1,768,427.2);


(lib.light_1 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層 1 複製
	this.instance = new lib.元件2();
	this.instance.parent = this;
	this.instance.setTransform(556.6,-16.1,0.8,0.8,-2.7,0,0,525.5,-3.1);

	this.timeline.addTween(cjs.Tween.get(this.instance).to({scaleX:1,scaleY:1,y:-16.2,alpha:0},29,cjs.Ease.get(1)).to({scaleX:0.8,scaleY:0.8,alpha:1},30).wait(1));

	// 圖層 1
	this.instance_1 = new lib.元件2();
	this.instance_1.parent = this;
	this.instance_1.setTransform(477.5,-3.1,0.8,0.8,0,0,0,525.5,-3.1);
	this.instance_1.alpha = 0.699;

	this.timeline.addTween(cjs.Tween.get(this.instance_1).to({scaleX:1,scaleY:1,alpha:1},29,cjs.Ease.get(1)).to({scaleX:0.8,scaleY:0.8,alpha:0.699},30).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(57.1,-30.9,898.4,738.7);


// stage content:
(lib._983x878 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// light spot
	this.instance = new lib.lightspot();
	this.instance.parent = this;
	this.instance.setTransform(555.3,449.1,1.5,1.5,0,0,0,18.1,18);

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

	// light2
	this.instance_1 = new lib.light2_1();
	this.instance_1.parent = this;
	this.instance_1.setTransform(598.2,289,1.1,1.1,0,0,0,480,266.9);

	this.timeline.addTween(cjs.Tween.get(this.instance_1).wait(1));

	// light
	this.instance_2 = new lib.light_1();
	this.instance_2.parent = this;
	this.instance_2.setTransform(491.5,439,1,1,0,0,0,491.5,439);

	this.timeline.addTween(cjs.Tween.get(this.instance_2).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-316.5,408.1,1920,1006);
// library properties:
lib.properties = {
	width: 983,
	height: 878,
	fps: 18,
	color: "#FFFFFF",
	opacity: 0.00,
	manifest: [
		{src:"./images/animation/Path.png?1551175971646", id:"Path"},
		{src:"./images/animation/light.png?1551175971646", id:"light"},
		{src:"./images/animation/light2.png?1551175971646", id:"light2"}
	],
	preloads: []
};




})(lib = lib||{}, images = images||{}, createjs = createjs||{}, ss = ss||{}, AdobeAn = AdobeAn||{});
var lib, images, createjs, ss, AdobeAn;