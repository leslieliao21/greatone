(function (lib_l1, img, cjs, ss, an) {

var p; // shortcut to reference prototypes
lib_l1.ssMetadata = [];


// symbols:



(lib_l1.inv_line_1_1 = function() {
	this.initialize(img.inv_line_1_1);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,341,262);


(lib_l1.inv_line_1_2 = function() {
	this.initialize(img.inv_line_1_2);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,341,262);


(lib_l1.line_move = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層 1
	this.instance = new lib_l1.inv_line_1_1();
	this.instance.parent = this;

	this.instance_1 = new lib_l1.inv_line_1_2();
	this.instance_1.parent = this;

	this.timeline.addTween(cjs.Tween.get({}).to({state:[{t:this.instance}]}).to({state:[{t:this.instance_1}]},2).wait(2));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(0,0,341,262);


// stage content:
(lib_l1.line1 = function(mode,startPosition,loop) {
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
	var mask_graphics_0 = new cjs.Graphics().p("A7pVaMAAAgqzMA3TAAAMAAAAqzg");
	var mask_graphics_1 = new cjs.Graphics().p("A7pVaMAAAgqzMA3TAAAMAAAAqzg");
	var mask_graphics_2 = new cjs.Graphics().p("A7pVaMAAAgqzMA3TAAAMAAAAqzg");
	var mask_graphics_3 = new cjs.Graphics().p("A7pVaMAAAgqzMA3TAAAMAAAAqzg");
	var mask_graphics_4 = new cjs.Graphics().p("A7pVaMAAAgqzMA3TAAAMAAAAqzg");
	var mask_graphics_5 = new cjs.Graphics().p("A7pVaMAAAgqzMA3TAAAMAAAAqzg");
	var mask_graphics_6 = new cjs.Graphics().p("A7pVaMAAAgqzMA3TAAAMAAAAqzg");
	var mask_graphics_7 = new cjs.Graphics().p("A7pVaMAAAgqzMA3TAAAMAAAAqzg");
	var mask_graphics_8 = new cjs.Graphics().p("A7pVaMAAAgqzMA3TAAAMAAAAqzg");
	var mask_graphics_9 = new cjs.Graphics().p("A7pVaMAAAgqzMA3TAAAMAAAAqzg");
	var mask_graphics_10 = new cjs.Graphics().p("A7pVaMAAAgqzMA3TAAAMAAAAqzg");
	var mask_graphics_11 = new cjs.Graphics().p("A7pVaMAAAgqzMA3TAAAMAAAAqzg");
	var mask_graphics_12 = new cjs.Graphics().p("A7pVaMAAAgqzMA3TAAAMAAAAqzg");
	var mask_graphics_13 = new cjs.Graphics().p("A7pVaMAAAgqzMA3TAAAMAAAAqzg");
	var mask_graphics_14 = new cjs.Graphics().p("A7pVaMAAAgqzMA3TAAAMAAAAqzg");
	var mask_graphics_15 = new cjs.Graphics().p("A7pVaMAAAgqzMA3TAAAMAAAAqzg");
	var mask_graphics_16 = new cjs.Graphics().p("A7pVaMAAAgqzMA3TAAAMAAAAqzg");
	var mask_graphics_17 = new cjs.Graphics().p("A7pVaMAAAgqzMA3TAAAMAAAAqzg");
	var mask_graphics_18 = new cjs.Graphics().p("A7pVaMAAAgqzMA3TAAAMAAAAqzg");
	var mask_graphics_19 = new cjs.Graphics().p("A7pVaMAAAgqzMA3TAAAMAAAAqzg");
	var mask_graphics_20 = new cjs.Graphics().p("A7pVaMAAAgqzMA3TAAAMAAAAqzg");

	this.timeline.addTween(cjs.Tween.get(mask).to({graphics:mask_graphics_0,x:521,y:388}).wait(1).to({graphics:mask_graphics_1,x:486.7,y:388}).wait(1).to({graphics:mask_graphics_2,x:452.3,y:388}).wait(1).to({graphics:mask_graphics_3,x:418,y:388}).wait(1).to({graphics:mask_graphics_4,x:383.7,y:388}).wait(1).to({graphics:mask_graphics_5,x:349.3,y:388}).wait(1).to({graphics:mask_graphics_6,x:315,y:388}).wait(1).to({graphics:mask_graphics_7,x:315,y:356.2}).wait(1).to({graphics:mask_graphics_8,x:315,y:324.5}).wait(1).to({graphics:mask_graphics_9,x:315,y:292.7}).wait(1).to({graphics:mask_graphics_10,x:315,y:261}).wait(1).to({graphics:mask_graphics_11,x:315,y:229.3}).wait(1).to({graphics:mask_graphics_12,x:315,y:197.5}).wait(1).to({graphics:mask_graphics_13,x:315,y:165.8}).wait(1).to({graphics:mask_graphics_14,x:315,y:134}).wait(1).to({graphics:mask_graphics_15,x:290.5,y:133.2}).wait(1).to({graphics:mask_graphics_16,x:266,y:132.4}).wait(1).to({graphics:mask_graphics_17,x:241.5,y:131.5}).wait(1).to({graphics:mask_graphics_18,x:217,y:130.7}).wait(1).to({graphics:mask_graphics_19,x:192.5,y:129.9}).wait(1).to({graphics:mask_graphics_20,x:168,y:129}).wait(3));

	// 圖層 1
	this.instance = new lib_l1.line_move();
	this.instance.parent = this;
	this.instance.setTransform(170.5,131,1,1,0,0,0,170.5,131);

	var maskedShapeInstanceList = [this.instance];

	for(var shapedInstanceItr = 0; shapedInstanceItr < maskedShapeInstanceList.length; shapedInstanceItr++) {
		maskedShapeInstanceList[shapedInstanceItr].mask = mask;
	}

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(23));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = null;
// lib_l1rary properties:
lib_l1.properties = {
	width: 341,
	height: 262,
	fps: 18,
	color: "#FFFFFF",
	opacity: 0.00,
	manifest: [
		{src:"./images/animation/inv_line_1_1.png?1552896371184", id:"inv_line_1_1"},
		{src:"./images/animation/inv_line_1_2.png?1552896371184", id:"inv_line_1_2"}
	],
	preloads: []
};




})(lib_l1 = lib_l1||{}, images_l1 = images_l1||{}, createjs = createjs||{}, ss = ss||{}, AdobeAn = AdobeAn||{});
var lib_l1, images_l1, createjs, ss, AdobeAn;