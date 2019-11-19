(function (lib_l3, img, cjs, ss, an) {

var p; // shortcut to reference prototypes
lib_l3.ssMetadata = [];


// symbols:



(lib_l3.inv_line_3_1 = function() {
	this.initialize(img.inv_line_3_1);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,239,2);


(lib_l3.inv_line_3_2 = function() {
	this.initialize(img.inv_line_3_2);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,239,2);


(lib_l3.line_move = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層 1
	this.instance = new lib_l3.inv_line_3_1();
	this.instance.parent = this;

	this.instance_1 = new lib_l3.inv_line_3_2();
	this.instance_1.parent = this;

	this.timeline.addTween(cjs.Tween.get({}).to({state:[{t:this.instance}]}).to({state:[{t:this.instance_1}]},2).wait(2));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(0,0,239,2);


// stage content:
(lib_l3.line3 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// timeline functions:
	this.frame_17 = function() {
		this.stop()
	}

	// actions tween:
	this.timeline.addTween(cjs.Tween.get(this).wait(17).call(this.frame_17).wait(1));

	// 圖層 2 (mask)
	var mask = new cjs.Shape();
	mask._off = true;
	var mask_graphics_0 = new cjs.Graphics().p("Ay2BGIAAiLMAlpAAAIAACLg");
	var mask_graphics_1 = new cjs.Graphics().p("Ay0BGIAAiLMAlpAAAIAACLg");
	var mask_graphics_2 = new cjs.Graphics().p("Ay0BGIAAiLMAlpAAAIAACLg");
	var mask_graphics_3 = new cjs.Graphics().p("Ay0BGIAAiLMAlpAAAIAACLg");
	var mask_graphics_4 = new cjs.Graphics().p("Ay0BGIAAiLMAlpAAAIAACLg");
	var mask_graphics_5 = new cjs.Graphics().p("Ay0BGIAAiLMAlpAAAIAACLg");
	var mask_graphics_6 = new cjs.Graphics().p("Ay0BGIAAiLMAlpAAAIAACLg");
	var mask_graphics_7 = new cjs.Graphics().p("Ay0BGIAAiLMAlpAAAIAACLg");
	var mask_graphics_8 = new cjs.Graphics().p("Ay0BGIAAiLMAlpAAAIAACLg");
	var mask_graphics_9 = new cjs.Graphics().p("Ay0BGIAAiLMAlpAAAIAACLg");
	var mask_graphics_10 = new cjs.Graphics().p("Ay0BGIAAiLMAlpAAAIAACLg");
	var mask_graphics_11 = new cjs.Graphics().p("Ay0BGIAAiLMAlpAAAIAACLg");
	var mask_graphics_12 = new cjs.Graphics().p("Ay0BGIAAiLMAlpAAAIAACLg");
	var mask_graphics_13 = new cjs.Graphics().p("Ay0BGIAAiLMAlpAAAIAACLg");
	var mask_graphics_14 = new cjs.Graphics().p("Ay0BGIAAiLMAlpAAAIAACLg");
	var mask_graphics_15 = new cjs.Graphics().p("Ay0BGIAAiLMAlpAAAIAACLg");
	var mask_graphics_16 = new cjs.Graphics().p("Ay0BGIAAiLMAlpAAAIAACLg");
	var mask_graphics_17 = new cjs.Graphics().p("Ay0BGIAAiLMAlpAAAIAACLg");

	this.timeline.addTween(cjs.Tween.get(mask).to({graphics:mask_graphics_0,x:-120.7,y:1.8}).wait(1).to({graphics:mask_graphics_1,x:-106.8,y:1.8}).wait(1).to({graphics:mask_graphics_2,x:-92.7,y:1.8}).wait(1).to({graphics:mask_graphics_3,x:-78.5,y:1.8}).wait(1).to({graphics:mask_graphics_4,x:-64.4,y:1.8}).wait(1).to({graphics:mask_graphics_5,x:-50.2,y:1.8}).wait(1).to({graphics:mask_graphics_6,x:-36.1,y:1.8}).wait(1).to({graphics:mask_graphics_7,x:-21.9,y:1.8}).wait(1).to({graphics:mask_graphics_8,x:-7.8,y:1.8}).wait(1).to({graphics:mask_graphics_9,x:6.4,y:1.8}).wait(1).to({graphics:mask_graphics_10,x:20.5,y:1.8}).wait(1).to({graphics:mask_graphics_11,x:34.7,y:1.8}).wait(1).to({graphics:mask_graphics_12,x:48.8,y:1.8}).wait(1).to({graphics:mask_graphics_13,x:63,y:1.8}).wait(1).to({graphics:mask_graphics_14,x:77.1,y:1.8}).wait(1).to({graphics:mask_graphics_15,x:91.3,y:1.8}).wait(1).to({graphics:mask_graphics_16,x:105.4,y:1.8}).wait(1).to({graphics:mask_graphics_17,x:119.6,y:1.8}).wait(1));

	// 圖層 1
	this.instance = new lib_l3.line_move();
	this.instance.parent = this;
	this.instance.setTransform(119.5,1,1,1,0,0,0,119.5,1);

	var maskedShapeInstanceList = [this.instance];

	for(var shapedInstanceItr = 0; shapedInstanceItr < maskedShapeInstanceList.length; shapedInstanceItr++) {
		maskedShapeInstanceList[shapedInstanceItr].mask = mask;
	}

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(18));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = null;
// lib_l3rary properties:
lib_l3.properties = {
	width: 239,
	height: 2,
	fps: 18,
	color: "#FFFFFF",
	opacity: 0.00,
	manifest: [
		{src:"./images/animation/inv_line_3_1.png?1552897780493", id:"inv_line_3_1"},
		{src:"./images/animation/inv_line_3_2.png?1552897780493", id:"inv_line_3_2"}
	],
	preloads: []
};




})(lib_l3 = lib_l3||{}, images_l3 = images_l3||{}, createjs = createjs||{}, ss = ss||{}, AdobeAn = AdobeAn||{});
var lib_l3, images_l3, createjs, ss, AdobeAn;