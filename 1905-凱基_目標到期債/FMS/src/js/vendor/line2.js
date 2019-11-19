(function (lib_l2, img, cjs, ss, an) {

var p; // shortcut to reference prototypes
lib_l2.ssMetadata = [];


// symbols:



(lib_l2.inv_line_2_1 = function() {
	this.initialize(img.inv_line_2_1);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,265,240);


(lib_l2.inv_line_2_2 = function() {
	this.initialize(img.inv_line_2_2);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,265,240);


(lib_l2.line_move = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層 1
	this.instance = new lib_l2.inv_line_2_1();
	this.instance.parent = this;

	this.instance_1 = new lib_l2.inv_line_2_2();
	this.instance_1.parent = this;

	this.timeline.addTween(cjs.Tween.get({}).to({state:[{t:this.instance}]}).to({state:[{t:this.instance_1}]},2).wait(2));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(0,0,265,240);


// stage content:
(lib_l2.line2 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// timeline functions:
	this.frame_22 = function() {
		this.stop()
	}

	// actions tween:
	this.timeline.addTween(cjs.Tween.get(this).wait(22).call(this.frame_22).wait(1));

	// 圖層 2 (mask)
	var mask = new cjs.Shape();
	mask._off = true;
	var mask_graphics_0 = new cjs.Graphics().p("EgVAAmGMAAAgmbMAqBAAAMAAAAmbg");
	var mask_graphics_1 = new cjs.Graphics().p("EgVAAkNMAAAgmbMAqBAAAMAAAAmbg");
	var mask_graphics_2 = new cjs.Graphics().p("EgVAAiUMAAAgmbMAqBAAAMAAAAmbg");
	var mask_graphics_3 = new cjs.Graphics().p("EgVAAgbMAAAgmbMAqBAAAMAAAAmbg");
	var mask_graphics_4 = new cjs.Graphics().p("A1AeiMAAAgmbMAqBAAAMAAAAmbg");
	var mask_graphics_5 = new cjs.Graphics().p("A1AcpMAAAgmbMAqBAAAMAAAAmbg");
	var mask_graphics_6 = new cjs.Graphics().p("A1AawMAAAgmbMAqBAAAMAAAAmbg");
	var mask_graphics_7 = new cjs.Graphics().p("A1AY3MAAAgmbMAqBAAAMAAAAmbg");
	var mask_graphics_8 = new cjs.Graphics().p("A1AW+MAAAgmbMAqBAAAMAAAAmbg");
	var mask_graphics_9 = new cjs.Graphics().p("A1AVFMAAAgmbMAqBAAAMAAAAmbg");
	var mask_graphics_10 = new cjs.Graphics().p("A1ATOMAAAgmbMAqBAAAMAAAAmbg");
	var mask_graphics_11 = new cjs.Graphics().p("A1ATOMAAAgmbMAqBAAAMAAAAmbg");
	var mask_graphics_12 = new cjs.Graphics().p("A1ATOMAAAgmbMAqBAAAMAAAAmbg");
	var mask_graphics_13 = new cjs.Graphics().p("A1ATOMAAAgmbMAqBAAAMAAAAmbg");
	var mask_graphics_14 = new cjs.Graphics().p("A1ATOMAAAgmbMAqBAAAMAAAAmbg");
	var mask_graphics_15 = new cjs.Graphics().p("A1ATOMAAAgmbMAqBAAAMAAAAmbg");
	var mask_graphics_16 = new cjs.Graphics().p("A1ATOMAAAgmbMAqBAAAMAAAAmbg");
	var mask_graphics_17 = new cjs.Graphics().p("A1ATOMAAAgmbMAqBAAAMAAAAmbg");
	var mask_graphics_18 = new cjs.Graphics().p("A1ATOMAAAgmbMAqBAAAMAAAAmbg");
	var mask_graphics_19 = new cjs.Graphics().p("A1ATOMAAAgmbMAqBAAAMAAAAmbg");
	var mask_graphics_20 = new cjs.Graphics().p("A1ATOMAAAgmbMAqBAAAMAAAAmbg");
	var mask_graphics_21 = new cjs.Graphics().p("A1ATOMAAAgmbMAqBAAAMAAAAmbg");
	var mask_graphics_22 = new cjs.Graphics().p("A1ATOMAAAgmbMAqBAAAMAAAAmbg");

	this.timeline.addTween(cjs.Tween.get(mask).to({graphics:mask_graphics_0,x:-104,y:243.8}).wait(1).to({graphics:mask_graphics_1,x:-104,y:231.7}).wait(1).to({graphics:mask_graphics_2,x:-104,y:219.6}).wait(1).to({graphics:mask_graphics_3,x:-104,y:207.5}).wait(1).to({graphics:mask_graphics_4,x:-104,y:195.4}).wait(1).to({graphics:mask_graphics_5,x:-104,y:183.3}).wait(1).to({graphics:mask_graphics_6,x:-104,y:171.2}).wait(1).to({graphics:mask_graphics_7,x:-104,y:159.1}).wait(1).to({graphics:mask_graphics_8,x:-104,y:147}).wait(1).to({graphics:mask_graphics_9,x:-104,y:134.9}).wait(1).to({graphics:mask_graphics_10,x:-104,y:122.6}).wait(1).to({graphics:mask_graphics_11,x:-84.3,y:122.2}).wait(1).to({graphics:mask_graphics_12,x:-64.6,y:121.9}).wait(1).to({graphics:mask_graphics_13,x:-44.8,y:121.6}).wait(1).to({graphics:mask_graphics_14,x:-25.1,y:121.2}).wait(1).to({graphics:mask_graphics_15,x:-5.4,y:120.9}).wait(1).to({graphics:mask_graphics_16,x:14.3,y:120.6}).wait(1).to({graphics:mask_graphics_17,x:34,y:120.2}).wait(1).to({graphics:mask_graphics_18,x:53.7,y:119.9}).wait(1).to({graphics:mask_graphics_19,x:73.4,y:119.6}).wait(1).to({graphics:mask_graphics_20,x:93.1,y:119.2}).wait(1).to({graphics:mask_graphics_21,x:112.8,y:118.9}).wait(1).to({graphics:mask_graphics_22,x:132.5,y:118.6}).wait(1));

	// 圖層 1
	this.instance = new lib_l2.line_move();
	this.instance.parent = this;
	this.instance.setTransform(132.5,120,1,1,0,0,0,132.5,120);

	var maskedShapeInstanceList = [this.instance];

	for(var shapedInstanceItr = 0; shapedInstanceItr < maskedShapeInstanceList.length; shapedInstanceItr++) {
		maskedShapeInstanceList[shapedInstanceItr].mask = mask;
	}

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(23));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = null;
// lib_l2rary properties:
lib_l2.properties = {
	width: 265,
	height: 240,
	fps: 18,
	color: "#FFFFFF",
	opacity: 0.00,
	manifest: [
		{src:"./images/animation/inv_line_2_1.png?1552897427986", id:"inv_line_2_1"},
		{src:"./images/animation/inv_line_2_2.png?1552897427986", id:"inv_line_2_2"}
	],
	preloads: []
};




})(lib_l2 = lib_l2||{}, images_l2 = images_l2||{}, createjs = createjs||{}, ss = ss||{}, AdobeAn = AdobeAn||{});
var lib_l2, images_l2, createjs, ss, AdobeAn;