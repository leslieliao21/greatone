(function (lib, img, cjs, ss, an) {

var p; // shortcut to reference prototypes
lib.ssMetadata = [];


// symbols:



(lib.Ribbon_b = function() {
	this.initialize(img.Ribbon_b);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,24,15);


(lib.Ribbon_p = function() {
	this.initialize(img.Ribbon_p);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,20,22);


(lib.Ribbon_s = function() {
	this.initialize(img.Ribbon_s);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,14,22);


(lib.Ribbon_s2 = function() {
	this.initialize(img.Ribbon_s2);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,40,68);


(lib.Ribbon_y = function() {
	this.initialize(img.Ribbon_y);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,16,23);// helper functions:

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


(lib.Ribbon_y_1 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層 1
	this.instance = new lib.Ribbon_y();
	this.instance.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.Ribbon_y_1, new cjs.Rectangle(0,0,16,23), null);


(lib.Ribbon_s2_1 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層 1
	this.instance = new lib.Ribbon_s2();
	this.instance.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.Ribbon_s2_1, new cjs.Rectangle(0,0,40,68), null);


(lib.Ribbon_s_1 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層 1
	this.instance = new lib.Ribbon_s();
	this.instance.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.Ribbon_s_1, new cjs.Rectangle(0,0,14,22), null);


(lib.Ribbon_p_1 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層 1
	this.instance = new lib.Ribbon_p();
	this.instance.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.Ribbon_p_1, new cjs.Rectangle(0,0,20,22), null);


(lib.Ribbon_b_1 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層 1
	this.instance = new lib.Ribbon_b();
	this.instance.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.Ribbon_b_1, new cjs.Rectangle(0,0,24,15), null);


// stage content:
(lib._1200x627 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// Ribbon_p   複製 2
	this.instance = new lib.Ribbon_p_1();
	this.instance.parent = this;
	this.instance.setTransform(1121.3,-287.9,1,1,0,0,0,10,11);
	this.instance._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(10).to({_off:false},0).to({rotation:360,guide:{path:[1121.2,-287.9,1117.3,-280.1,1112.3,-267.9,1100.9,-240,1093.5,-210.9,1085.7,-179.8,1083.4,-151.3,1078.8,-94.5,1096.3,-47.9,1106.8,-19.9,1129.3,38.1,1148.6,89.3,1158.3,124.9,1158.8,126.7,1159.2,128.5,1162,139.1,1164.2,149.2,1171.3,181.4,1172.2,208.3,1173.5,244.1,1164.2,273.2,1162.4,278.8,1160.3,284.1,1159.8,285.4,1159.2,286.7,1148.1,313.2,1121.8,355.6,1106.4,380.2,1098.6,392.8,1085.1,414.9,1076,431.6,1073.4,436.5,1070.9,441.4,1050.4,481.2,1041.9,515.9,1030,564.3,1038.3,612.2,1041.3,630,1046.2,645.9]}},50,cjs.Ease.get(1)).to({_off:true},1).wait(35));

	// Ribbon_b   複製 2
	this.instance_1 = new lib.Ribbon_b_1();
	this.instance_1.parent = this;
	this.instance_1.setTransform(761.3,-308,1,1,0,0,0,12,7.5);
	this.instance_1._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_1).wait(21).to({_off:false},0).to({rotation:360,guide:{path:[761.2,-307.9,757.3,-300.1,752.3,-287.9,740.9,-260,733.5,-230.9,725.7,-199.8,723.4,-171.3,718.8,-114.5,736.3,-67.9,746.8,-39.9,769.3,18.1,788.6,69.3,798.3,104.9,798.8,106.7,799.2,108.5,802,119.1,804.2,129.2,811.3,161.5,812.2,188.4,813.5,224.1,804.2,253.2,802.4,258.8,800.3,264.1,799.8,265.4,799.2,266.7,788.1,293.2,761.8,335.6,746.4,360.2,738.6,372.8,725.1,394.9,716,411.6,713.4,416.5,710.9,421.4,690.4,461.2,681.9,495.9,670,544.3,678.3,592.2,693.3,678.5,749.3,719,766.8,731.6,786.3,738.2,792.4,740.3,797.2,741.3]}},50,cjs.Ease.get(1)).to({_off:true},1).wait(24));

	// Ribbon_s2 複製
	this.instance_2 = new lib.Ribbon_s2_1();
	this.instance_2.parent = this;
	this.instance_2.setTransform(754.7,-116.3,1,1,0,0,0,20,34);
	this.instance_2._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_2).wait(3).to({_off:false},0).to({rotation:360,guide:{path:[754.7,-116.3,750.7,-111.1,746.2,-104.7,725.5,-75.2,711.1,-43.9,690.9,-0.2,686.4,40.8,680.8,92.1,700.1,136.1,718.1,177.3,753.4,217.6,765.7,231.6,784.4,250.4,794.8,260.8,814.6,280.7,848.6,315.4,861.6,341.4,879,376.3,872.1,416.1,859.6,488.6,728.6,603.6,687.7,639.6,639.8,675.5,619.4,690.8,604.9,700.9]}},65,cjs.Ease.get(1)).to({_off:true},1).wait(27));

	// Ribbon_s   複製 2
	this.instance_3 = new lib.Ribbon_s_1();
	this.instance_3.parent = this;
	this.instance_3.setTransform(96.4,-151.8,1,1,0,0,0,7,11);

	this.timeline.addTween(cjs.Tween.get(this.instance_3).to({rotation:360,guide:{path:[96.4,-151.7,101.3,-140.6,107.7,-122.2,120.5,-85.1,127.5,-47.9,137.4,4.1,134.3,48.9,130.4,104.9,106.3,146.1,80.8,190,67.9,246.8,55.8,300.8,57.1,357.6,58.5,414,72.9,461.7,87.9,511.2,114.3,542.1,159.3,594.7,177.3,664.7,182.9,686.5,185.2,707.5,186.1,716.5,186.3,722.2]}},65,cjs.Ease.get(1)).to({_off:true},1).wait(30));

	// Ribbon_s 複製
	this.instance_4 = new lib.Ribbon_s_1();
	this.instance_4.parent = this;
	this.instance_4.setTransform(876.4,-151.8,1,1,0,0,0,7,11);
	this.instance_4._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_4).wait(30).to({_off:false},0).to({rotation:360,guide:{path:[876.4,-151.7,881.3,-140.6,887.7,-122.2,900.5,-85.1,907.5,-47.9,917.4,4.1,914.3,48.9,910.4,104.9,886.3,146.1,860.7,190,847.8,246.7,835.7,300.8,837,357.6,838.4,414,852.8,461.7,867.8,511.2,894.3,542.1,930.4,584.3,949.1,637.7]}},65,cjs.Ease.get(1)).wait(1));

	// Ribbon_p 複製
	this.instance_5 = new lib.Ribbon_p_1();
	this.instance_5.parent = this;
	this.instance_5.setTransform(401.3,-287.9,1,1,0,0,0,10,11);
	this.instance_5._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_5).wait(31).to({_off:false},0).to({rotation:360,guide:{path:[401.2,-287.9,397.3,-280.1,392.3,-267.9,380.9,-240,373.5,-210.9,365.7,-179.8,363.4,-151.3,358.8,-94.5,376.3,-47.9,386.8,-19.9,409.3,38.1,428.6,89.3,438.3,124.9,438.8,126.7,439.2,128.5,442,139.1,444.2,149.2,451.3,181.4,452.2,208.3,453.5,244.1,444.2,273.2,442.4,278.8,440.3,284.1,439.8,285.4,439.2,286.7,428.1,313.2,401.8,355.6,386.4,380.2,378.6,392.8,365.1,414.9,356,431.6,353.4,436.5,350.9,441.4,330.4,481.2,321.9,515.9,310,564.3,318.3,612.2,321.3,630,326.2,645.9]}},50,cjs.Ease.get(1)).to({_off:true},1).wait(14));

	// Ribbon_b 複製
	this.instance_6 = new lib.Ribbon_b_1();
	this.instance_6.parent = this;
	this.instance_6.setTransform(1121.3,-188,1,1,0,0,0,12,7.5);
	this.instance_6._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_6).wait(19).to({_off:false},0).to({rotation:360,guide:{path:[1121.2,-187.9,1117.3,-180.1,1112.3,-167.9,1100.9,-140,1093.5,-110.9,1085.7,-79.8,1083.4,-51.3,1078.8,5.5,1096.3,52.1,1106.8,80.1,1129.3,138.1,1148.6,189.3,1158.3,224.9,1158.8,226.7,1159.2,228.5,1162,239.1,1164.2,249.2,1171.3,281.5,1172.2,308.4,1173.5,344.1,1164.2,373.2,1162.4,378.8,1160.3,384.1,1159.8,385.4,1159.2,386.7,1148.1,413.2,1121.8,455.6,1106.4,480.2,1098.6,492.8,1085.1,514.9,1076,531.6,1073.4,536.5,1070.9,541.4,1050.4,581.2,1041.9,615.9,1030,664.3,1038.3,712.2,1053.3,798.5,1109.3,839,1126.8,851.6,1146.3,858.2,1152.4,860.3,1157.2,861.3]}},50,cjs.Ease.get(1)).to({_off:true},1).wait(26));

	// Ribbon_p 複製
	this.instance_7 = new lib.Ribbon_p_1();
	this.instance_7.parent = this;
	this.instance_7.setTransform(921.3,-247.9,1,1,0,0,0,10,11);
	this.instance_7._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_7).wait(45).to({_off:false},0).to({rotation:360,guide:{path:[921.2,-247.8,917.3,-240,912.3,-227.8,900.9,-199.9,893.5,-170.9,885.7,-139.8,883.4,-111.3,878.8,-54.5,896.3,-7.8,906.8,20.2,929.3,78.1,948.6,129.3,958.3,165,958.8,166.8,959.2,168.5,962,179.1,964.2,189.3,971.3,221.4,972.2,248.4,973.5,284.1,964.2,313.2,962.4,318.8,960.3,324.2,959.8,325.4,959.2,326.7,948.1,353.2,921.8,395.7,906.4,420.2,898.6,432.9,885.1,454.9,876,471.7,873.4,476.6,870.9,481.4,850.4,521.2,841.9,555.9,830,604.4,838.3,652.2,838.9,656,839.6,659.6]}},50,cjs.Ease.get(1)).wait(1));

	// Ribbon_y
	this.instance_8 = new lib.Ribbon_y_1();
	this.instance_8.parent = this;
	this.instance_8.setTransform(1040.3,-103.7,1,1,0,0,0,8,11.5);

	this.timeline.addTween(cjs.Tween.get(this.instance_8).to({rotation:360,guide:{path:[1040.2,-103.7,1040.4,-103.6,1040.5,-103.5,1051.6,-97.7,1063,-90.4,1099.4,-67.1,1125.6,-37.8,1162.3,3.2,1173.3,50.2,1187.1,109.1,1159.7,174.1,1141.3,217.5,1093.9,247.3,1075.7,258.8,1048.8,271.2,1046.2,272.3,1000.5,292.2,971.2,305,952.9,314.9,927.8,328.5,909.8,343.5,866,380,851.8,435.9,841,479,866.2,523.1,888.4,562.1,936.4,598.4,979.3,630.8,1034.8,655.4,1083.5,676.9,1127.8,686.5]}},69,cjs.Ease.get(1)).to({_off:true},1).wait(26));

	// Ribbon_s2 複製
	this.instance_9 = new lib.Ribbon_s2_1();
	this.instance_9.parent = this;
	this.instance_9.setTransform(714.7,-76.3,1,1,0,0,0,20,34);
	this.instance_9._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_9).wait(30).to({_off:false},0).to({rotation:360,guide:{path:[714.7,-76.3,710.7,-71.1,706.2,-64.7,685.5,-35.2,671.1,-3.9,650.9,39.8,646.4,80.8,640.8,132.1,660.1,176.1,678.1,217.3,713.4,257.6,725.7,271.6,744.4,290.4,754.8,300.8,774.6,320.7,808.6,355.4,821.6,381.4,839,416.3,832.1,456.1,819.6,528.6,688.6,643.6,647.7,679.6,599.8,715.5,579.4,730.8,564.9,740.9]}},65,cjs.Ease.get(1)).wait(1));

	// Ribbon_b 複製
	this.instance_10 = new lib.Ribbon_b_1();
	this.instance_10.parent = this;
	this.instance_10.setTransform(101.3,-148,1,1,0,0,0,12,7.5);
	this.instance_10._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_10).wait(45).to({_off:false},0).to({rotation:360,guide:{path:[101.2,-147.9,97.3,-140.1,92.3,-127.9,80.9,-100,73.6,-70.9,65.8,-39.8,63.5,-11.3,58.9,45.5,76.4,92.1,86.8,120.1,109.3,178.1,128.6,229.3,138.3,264.9,138.8,266.7,139.2,268.5,142,279.1,144.2,289.2,151.3,321.5,152.2,348.4,153.5,384.1,144.2,413.2,142.4,418.8,140.3,424.1,139.8,425.4,139.2,426.7,128.1,453.2,101.8,495.6,86.4,520.2,78.6,532.8,65.2,554.9,56.1,571.6,53.5,576.5,51,581.4,30.5,621.2,22,655.9,10.1,704.3,18.4,752.2,33.4,838.5,89.3,879,106.8,891.6,126.3,898.2,132.4,900.3,137.2,901.3]}},50,cjs.Ease.get(1)).wait(1));

	// Ribbon_p 複製
	this.instance_11 = new lib.Ribbon_p_1();
	this.instance_11.parent = this;
	this.instance_11.setTransform(381.3,-247.9,1,1,0,0,0,10,11);
	this.instance_11._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_11).wait(38).to({_off:false},0).to({rotation:360,guide:{path:[381.2,-247.9,377.3,-240.1,372.3,-227.9,360.9,-200,353.5,-170.9,345.7,-139.8,343.4,-111.3,338.8,-54.5,356.3,-7.9,366.8,20.1,389.3,78.1,408.6,129.3,418.3,164.9,418.8,166.7,419.2,168.5,422,179.1,424.2,189.2,431.3,221.4,432.2,248.3,433.5,284.1,424.2,313.2,422.4,318.8,420.3,324.1,419.8,325.4,419.2,326.7,408.1,353.2,381.8,395.6,366.4,420.2,358.6,432.8,345.1,454.9,336,471.6,333.4,476.5,330.9,481.4,310.4,521.2,301.9,555.9,290,604.3,298.3,652.2,301.3,670,306.2,685.9]}},50,cjs.Ease.get(1)).to({_off:true},1).wait(7));

	// Ribbon_b 複製
	this.instance_12 = new lib.Ribbon_b_1();
	this.instance_12.parent = this;
	this.instance_12.setTransform(581.3,-288,1,1,0,0,0,12,7.5);
	this.instance_12._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_12).wait(21).to({_off:false},0).to({rotation:360,guide:{path:[581.3,-287.9,577.4,-280.1,572.4,-267.9,560.9,-240,553.6,-210.9,545.7,-179.8,543.4,-151.3,538.9,-94.5,556.3,-47.9,566.8,-19.9,589.4,38.1,608.7,89.3,618.3,124.9,618.8,126.7,619.3,128.5,622.1,139.1,624.3,149.2,631.3,181.5,632.3,208.4,633.6,244.1,624.3,273.2,622.5,278.8,620.3,284.1,619.8,285.4,619.3,286.7,608.2,313.2,581.9,355.6,566.5,380.2,558.7,392.8,545.2,414.9,536.1,431.6,533.4,436.6,530.9,441.4,510.5,481.2,501.9,515.9,490,564.3,498.3,612.2,513.3,698.5,569.3,739,586.8,751.6,606.3,758.2,612.5,760.3,617.3,761.3]}},50,cjs.Ease.get(1)).to({_off:true},1).wait(24));

	// Ribbon_s2
	this.instance_13 = new lib.Ribbon_s2_1();
	this.instance_13.parent = this;
	this.instance_13.setTransform(194.7,-76.3,1,1,0,0,0,20,34);
	this.instance_13._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_13).wait(14).to({_off:false},0).to({rotation:360,guide:{path:[194.7,-76.3,190.7,-71.1,186.2,-64.7,165.5,-35.2,151.2,-3.9,131,39.8,126.5,80.8,120.9,132.1,140.2,176.1,158.1,217.3,193.4,257.6,205.7,271.6,224.4,290.4,234.8,300.8,254.6,320.7,288.6,355.4,301.6,381.4,319,416.3,312.1,456.1,299.6,528.6,168.6,643.6,127.8,679.6,79.9,715.5,59.5,730.8,45,740.9]}},65,cjs.Ease.get(1)).to({_off:true},1).wait(16));

	// Ribbon_s 複製
	this.instance_14 = new lib.Ribbon_s_1();
	this.instance_14.parent = this;
	this.instance_14.setTransform(216.4,-111.8,1,1,0,0,0,7,11);
	this.instance_14._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_14).wait(21).to({_off:false},0).to({rotation:360,guide:{path:[216.4,-111.7,221.3,-100.6,227.7,-82.2,240.5,-45.1,247.5,-7.9,257.4,44.1,254.3,88.9,250.4,144.9,226.3,186.1,200.7,230,187.8,286.8,175.7,340.8,177,397.6,178.4,454,192.8,501.7,207.8,551.2,234.3,582.1,279.3,634.7,297.3,704.7,302.9,726.5,305.2,747.5,306.1,756.5,306.3,762.2]}},65,cjs.Ease.get(1)).to({_off:true},1).wait(9));

	// Ribbon_s
	this.instance_15 = new lib.Ribbon_s_1();
	this.instance_15.parent = this;
	this.instance_15.setTransform(856.4,-111.8,1,1,0,0,0,7,11);

	this.timeline.addTween(cjs.Tween.get(this.instance_15).to({rotation:360,guide:{path:[856.4,-111.7,861.3,-100.6,867.7,-82.2,880.5,-45.1,887.5,-7.9,897.4,44.1,894.3,88.9,890.4,144.9,866.3,186.1,840.7,230,827.8,286.8,815.7,340.8,817,397.6,818.4,454,832.8,501.7,847.8,551.2,874.3,582.1,919.3,634.7,937.3,704.7,942.9,726.5,945.2,747.5,946.1,756.5,946.3,762.2]}},65,cjs.Ease.get(1)).to({_off:true},1).wait(30));

	// Ribbon_p
	this.instance_16 = new lib.Ribbon_p_1();
	this.instance_16.parent = this;
	this.instance_16.setTransform(381.3,-247.9,1,1,0,0,0,10,11);
	this.instance_16._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_16).wait(6).to({_off:false},0).to({rotation:360,guide:{path:[381.2,-247.9,377.3,-240.1,372.3,-227.9,360.9,-200,353.5,-170.9,345.7,-139.8,343.4,-111.3,338.8,-54.5,356.3,-7.9,366.8,20.1,389.3,78.1,408.6,129.3,418.3,164.9,418.8,166.7,419.2,168.5,422,179.1,424.2,189.2,431.3,221.4,432.2,248.3,433.5,284.1,424.2,313.2,422.4,318.8,420.3,324.1,419.8,325.4,419.2,326.7,408.1,353.2,381.8,395.6,366.4,420.2,358.6,432.8,345.1,454.9,336,471.6,333.4,476.5,330.9,481.4,310.4,521.2,301.9,555.9,290,604.3,298.3,652.2,301.3,670,306.2,685.9]}},50,cjs.Ease.get(1)).to({_off:true},1).wait(39));

	// Ribbon_b
	this.instance_17 = new lib.Ribbon_b_1();
	this.instance_17.parent = this;
	this.instance_17.setTransform(1101.3,-148,1,1,0,0,0,12,7.5);

	this.timeline.addTween(cjs.Tween.get(this.instance_17).to({rotation:360,guide:{path:[1101.3,-147.9,1097.4,-140.1,1092.4,-127.9,1080.9,-100,1073.6,-70.9,1065.7,-39.8,1063.4,-11.3,1058.9,45.5,1076.3,92.1,1086.8,120.1,1109.4,178.1,1128.7,229.3,1138.3,264.9,1138.8,266.7,1139.3,268.5,1142.1,279.1,1144.3,289.2,1151.3,321.5,1152.3,348.4,1153.6,384.1,1144.3,413.2,1142.5,418.8,1140.3,424.1,1139.8,425.4,1139.3,426.7,1128.2,453.2,1101.9,495.6,1086.5,520.2,1078.7,532.8,1065.2,554.9,1056.1,571.6,1053.4,576.6,1050.9,581.4,1030.5,621.2,1021.9,655.9,1010,704.3,1018.3,752.2,1033.3,838.5,1089.3,879,1106.8,891.6,1126.3,898.2,1132.5,900.3,1137.3,901.3]}},50,cjs.Ease.get(1)).to({_off:true},1).wait(45));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(192,150.7,1976,789.8);
// library properties:
lib.properties = {
	width: 1200,
	height: 627,
	fps: 18,
	color: "#FFFFFF",
	opacity: 0.00,
	manifest: [
		{src:"images/animation/Ribbon_b.png?1551176061703", id:"Ribbon_b"},
		{src:"images/animation/Ribbon_p.png?1551176061703", id:"Ribbon_p"},
		{src:"images/animation/Ribbon_s.png?1551176061703", id:"Ribbon_s"},
		{src:"images/animation/Ribbon_s2.png?1551176061703", id:"Ribbon_s2"},
		{src:"images/animation/Ribbon_y.png?1551176061703", id:"Ribbon_y"}
	],
	preloads: []
};




})(lib_s = lib_s||{}, images_s = images_s||{}, createjs = createjs||{}, ss = ss||{}, AdobeAn = AdobeAn||{});
var lib_s, images_s, createjs, ss, AdobeAn;