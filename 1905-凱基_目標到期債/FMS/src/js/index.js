// Header Canvas
  var canvas, stage, exportRoot, anim_container, dom_overlay_container, fnStartAnimation;
function handleFileLoad(evt, comp) {
	var images=comp.getImages();	
	if (evt && (evt.item.type == "image")) { images[evt.item.id] = evt.result; }	
}
function handleComplete(evt,comp) {
	//This function is always called, irrespective of the content. You can use the variable "stage" after it is created in token create_stage.
	var lib=comp.getLibrary();
	var ss=comp.getSpriteSheet();
	var queue = evt.target;
	var ssMetadata = lib.ssMetadata;
	for(var i=0; i<ssMetadata.length; i++) {
		ss[ssMetadata[i].name] = new createjs.SpriteSheet( {"images": [queue.getResult(ssMetadata[i].name)], "frames": ssMetadata[i].frames} )
	}
	exportRoot = new lib.index_an();
	stage = new lib.Stage(canvas);	
	//Registers the "tick" event listener.
	fnStartAnimation = function() {
		stage.addChild(exportRoot);
		createjs.Ticker.setFPS(lib.properties.fps);
		createjs.Ticker.addEventListener("tick", stage);
	}	    
	//Code to support hidpi screens and responsive scaling.
	AdobeAn.makeResponsive(false,'both',false,1,[canvas,anim_container,dom_overlay_container]);	
	AdobeAn.compositionLoaded(lib.properties.id);
	fnStartAnimation();
}
(function init() {
    canvas = document.getElementById("canvas");
	anim_container = document.getElementById("animation_container");
	dom_overlay_container = document.getElementById("dom_overlay_container");
	var comp=AdobeAn.getComposition("0E460126AF50334DA6D054B85A1C8F6E");
	var lib=comp.getLibrary();
	createjs.MotionGuidePlugin.install();
	var loader = new createjs.LoadQueue(false);
	loader.addEventListener("fileload", function(evt){handleFileLoad(evt,comp)});
	loader.addEventListener("complete", function(evt){handleComplete(evt,comp)});
	var lib=comp.getLibrary();
	loader.loadManifest(lib.properties.manifest);
})();



// Series Canvas
(function() {
  let canvas_s, stage_s, exportRoot_s, anim_container_s, dom_overlay_container_s, fnStartAnimation_s;
  function handleFileLoad_s(evt) {	
    if (evt.item.type == "image") { images_s[evt.item.id] = evt.result; }	
  }
  function handleComplete_s(evt) {
    //This function is always called, irrespective of the content. You can use the letiable "stage" after it is created in token create_stage.
    let queue = evt.target;
    let ssMetadata = lib_s.ssMetadata;
    for(let i=0; i<ssMetadata.length; i++) {
      ss[ssMetadata[i].name] = new createjs.SpriteSheet( {"images": [queue.getResult(ssMetadata[i].name)], "frames": ssMetadata[i].frames} )
    }
    exportRoot_s = new lib_s._1200x627();
    stage_s = new createjs.Stage(canvas_s);
    stage_s.addChild(exportRoot_s);	
    //Registers the "tick" event listener.
    fnStartAnimation_s = function() {
      createjs.Ticker.setFPS(lib_s.properties.fps);
      createjs.Ticker.addEventListener("tick", stage_s);
    }	    
    //Code to support hidpi screens and responsive scaling.
    function makeResponsive(isResp, respDim, isScale, scaleType) {		
      let lastW, lastH, lastS=1;		
      window.addEventListener('resize', resizeCanvas);		
      resizeCanvas();		
      function resizeCanvas() {			
        let w = lib_s.properties.width, h = lib_s.properties.height;			
        let iw = window.innerWidth, ih=window.innerHeight;			
        let pRatio = window.devicePixelRatio || 1, xRatio=iw/w, yRatio=ih/h, sRatio=1;			
        if(isResp) {                
          if((respDim=='width'&&lastW==iw) || (respDim=='height'&&lastH==ih)) {                    
            sRatio = lastS;                
          }				
          else if(!isScale) {					
            if(iw<w || ih<h)						
              sRatio = Math.min(xRatio, yRatio);				
          }				
          else if(scaleType==1) {					
            sRatio = Math.min(xRatio, yRatio);				
          }				
          else if(scaleType==2) {					
            sRatio = Math.max(xRatio, yRatio);				
          }			
        }			
        canvas_s.width = w*pRatio*sRatio;			
        canvas_s.height = h*pRatio*sRatio;
        canvas_s.style.width = dom_overlay_container_s.style.width = anim_container_s.style.width =  w*sRatio+'px';				
        canvas_s.style.height = anim_container_s.style.height = dom_overlay_container_s.style.height = h*sRatio+'px';
        stage_s.scaleX = pRatio*sRatio;			
        stage_s.scaleY = pRatio*sRatio;			
        lastW = iw; lastH = ih; lastS = sRatio;		
      }
    }
    makeResponsive(false,'both',false,1);	
    fnStartAnimation_s();
  }

  (function init_s() {
    canvas_s = document.getElementById("canvas_s");
    anim_container_s = document.getElementById("animation_container_s");
    dom_overlay_container_s = document.getElementById("dom_overlay_container_s");
    createjs.MotionGuidePlugin.install();
    images_s = images_s||{};
    let loader = new createjs.LoadQueue(false);
    loader.addEventListener("fileload", handleFileLoad_s);
    loader.addEventListener("complete", handleComplete_s);
    loader.loadManifest(lib_s.properties.manifest);
  })();

})();

// line1
let canvas_l1, stage_l1, exportRoot_l1, anim_container_l1, dom_overlay_container_l1, fnStartAnimation_l1;
function handleFileLoad_l1(evt) {	
  if (evt.item.type == "image") { images_l1[evt.item.id] = evt.result; }	
}
function handleComplete_l1(evt) {
  //This function is always called, irrespective of the content. You can use the variable "stage" after it is created in token create_stage.
  var queue = evt.target;
  var ssMetadata = lib_l1.ssMetadata;
  for(let i=0; i<ssMetadata.length; i++) {
    ss[ssMetadata[i].name] = new createjs.SpriteSheet( {"images": [queue.getResult(ssMetadata[i].name)], "frames": ssMetadata[i].frames} )
  }
  exportRoot_l1 = new lib_l1.line1();
  stage_l1 = new createjs.Stage(canvas_l1);
  stage_l1.addChild(exportRoot_l1);	
  //Registers the "tick" event listener.
  fnStartAnimation_l1 = function() {
    createjs.Ticker.setFPS(lib_l1.properties.fps);
    createjs.Ticker.addEventListener("tick", stage_l1);
  }	    
  //Code to support hidpi screens and responsive scaling.
  function makeResponsive(isResp, respDim, isScale, scaleType) {		
    var lastW, lastH, lastS=1;		
    window.addEventListener('resize', resizeCanvas);		
    resizeCanvas();		
    function resizeCanvas() {			
      var w = lib_l1.properties.width, h = lib_l1.properties.height;			
      var iw = window.innerWidth, ih=window.innerHeight;			
      var pRatio = window.devicePixelRatio || 1, xRatio=iw/w, yRatio=ih/h, sRatio=1;			
      if(isResp) {                
        if((respDim=='width'&&lastW==iw) || (respDim=='height'&&lastH==ih)) {                    
          sRatio = lastS;                
        }				
        else if(!isScale) {					
          if(iw<w || ih<h)						
            sRatio = Math.min(xRatio, yRatio);				
        }				
        else if(scaleType==1) {					
          sRatio = Math.min(xRatio, yRatio);				
        }				
        else if(scaleType==2) {					
          sRatio = Math.max(xRatio, yRatio);				
        }			
      }			
      canvas_l1.width = w*pRatio*sRatio;			
      canvas_l1.height = h*pRatio*sRatio;
      canvas_l1.style.width = dom_overlay_container_l1.style.width = anim_container_l1.style.width =  w*sRatio+'px';				
      canvas_l1.style.height = anim_container_l1.style.height = dom_overlay_container_l1.style.height = h*sRatio+'px';
      stage_l1.scaleX = pRatio*sRatio;			
      stage_l1.scaleY = pRatio*sRatio;			
      lastW = iw; lastH = ih; lastS = sRatio;		
    }
  }
  makeResponsive(false,'both',false,1);	
  fnStartAnimation_l1();
}
function init_l1() { 
  canvas_l1 = document.getElementById("canvas_l1");
  anim_container_l1 = document.getElementById("animation_container_l1");
  dom_overlay_container_l1 = document.getElementById("dom_overlay_container_l1");
  images_l1 = images_l1||{};
  var loader = new createjs.LoadQueue(false);
  loader.addEventListener("fileload", handleFileLoad_l1);
  loader.addEventListener("complete", handleComplete_l1);
  loader.loadManifest(lib_l1.properties.manifest);
}
// line2
let canvas_l2, stage_l2, exportRoot_l2, anim_container_l2, dom_overlay_container_l2, fnStartAnimation_l2;
function handleFileLoad_l2(evt) {	
  if (evt.item.type == "image") { images_l2[evt.item.id] = evt.result; }	
}
function handleComplete_l2(evt) {
  //This function is always called, irrespective of the content. You can use the variable "stage" after it is created in token create_stage.
  var queue = evt.target;
  var ssMetadata = lib_l2.ssMetadata;
  for(let i=0; i<ssMetadata.length; i++) {
    ss[ssMetadata[i].name] = new createjs.SpriteSheet( {"images": [queue.getResult(ssMetadata[i].name)], "frames": ssMetadata[i].frames} )
  }
  exportRoot_l2 = new lib_l2.line2();
  stage_l2 = new createjs.Stage(canvas_l2);
  stage_l2.addChild(exportRoot_l2);	
  //Registers the "tick" event listener.
  fnStartAnimation_l2 = function() {
    createjs.Ticker.setFPS(lib_l2.properties.fps);
    createjs.Ticker.addEventListener("tick", stage_l2);
  }	    
  //Code to support hidpi screens and responsive scaling.
  function makeResponsive(isResp, respDim, isScale, scaleType) {		
    var lastW, lastH, lastS=1;		
    window.addEventListener('resize', resizeCanvas);		
    resizeCanvas();		
    function resizeCanvas() {			
      var w = lib_l2.properties.width, h = lib_l2.properties.height;			
      var iw = window.innerWidth, ih=window.innerHeight;			
      var pRatio = window.devicePixelRatio || 1, xRatio=iw/w, yRatio=ih/h, sRatio=1;			
      if(isResp) {                
        if((respDim=='width'&&lastW==iw) || (respDim=='height'&&lastH==ih)) {                    
          sRatio = lastS;                
        }				
        else if(!isScale) {					
          if(iw<w || ih<h)						
            sRatio = Math.min(xRatio, yRatio);				
        }				
        else if(scaleType==1) {					
          sRatio = Math.min(xRatio, yRatio);				
        }				
        else if(scaleType==2) {					
          sRatio = Math.max(xRatio, yRatio);				
        }			
      }			
      canvas_l2.width = w*pRatio*sRatio;			
      canvas_l2.height = h*pRatio*sRatio;
      canvas_l2.style.width = dom_overlay_container_l2.style.width = anim_container_l2.style.width =  w*sRatio+'px';				
      canvas_l2.style.height = anim_container_l2.style.height = dom_overlay_container_l2.style.height = h*sRatio+'px';
      stage_l2.scaleX = pRatio*sRatio;			
      stage_l2.scaleY = pRatio*sRatio;			
      lastW = iw; lastH = ih; lastS = sRatio;		
    }
  }
  makeResponsive(false,'both',false,1);	
  fnStartAnimation_l2();
}
function init_l2() {
  canvas_l2 = document.getElementById("canvas_l2");
  anim_container_l2 = document.getElementById("animation_container_l2");
  dom_overlay_container_l2 = document.getElementById("dom_overlay_container_l2");
  images_l2 = images_l2||{};
  var loader = new createjs.LoadQueue(false);
  loader.addEventListener("fileload", handleFileLoad_l2);
  loader.addEventListener("complete", handleComplete_l2);
  loader.loadManifest(lib_l2.properties.manifest);
}
// line3
let canvas_l3, stage_l3, exportRoot_l3, anim_container_l3, dom_overlay_container_l3, fnStartAnimation_l3;
function handleFileLoad_l3(evt) {	
  if (evt.item.type == "image") { images_l3[evt.item.id] = evt.result; }	
}
function handleComplete_l3(evt) {
  //This function is always called, irrespective of the content. You can use the variable "stage" after it is created in token create_stage.
  var queue = evt.target;
  var ssMetadata = lib_l3.ssMetadata;
  for(let i=0; i<ssMetadata.length; i++) {
    ss[ssMetadata[i].name] = new createjs.SpriteSheet( {"images": [queue.getResult(ssMetadata[i].name)], "frames": ssMetadata[i].frames} )
  }
  exportRoot_l3 = new lib_l3.line3();
  stage_l3 = new createjs.Stage(canvas_l3);
  stage_l3.addChild(exportRoot_l3);	
  //Registers the "tick" event listener.
  fnStartAnimation_l3 = function() {
    createjs.Ticker.setFPS(lib_l3.properties.fps);
    createjs.Ticker.addEventListener("tick", stage_l3);
  }	    
  //Code to support hidpi screens and responsive scaling.
  function makeResponsive(isResp, respDim, isScale, scaleType) {		
    var lastW, lastH, lastS=1;		
    window.addEventListener('resize', resizeCanvas);		
    resizeCanvas();		
    function resizeCanvas() {			
      var w = lib_l3.properties.width, h = lib_l3.properties.height;			
      var iw = window.innerWidth, ih=window.innerHeight;			
      var pRatio = window.devicePixelRatio || 1, xRatio=iw/w, yRatio=ih/h, sRatio=1;			
      if(isResp) {                
        if((respDim=='width'&&lastW==iw) || (respDim=='height'&&lastH==ih)) {                    
          sRatio = lastS;                
        }				
        else if(!isScale) {					
          if(iw<w || ih<h)						
            sRatio = Math.min(xRatio, yRatio);				
        }				
        else if(scaleType==1) {					
          sRatio = Math.min(xRatio, yRatio);				
        }				
        else if(scaleType==2) {					
          sRatio = Math.max(xRatio, yRatio);				
        }			
      }			
      canvas_l3.width = w*pRatio*sRatio;			
      canvas_l3.height = h*pRatio*sRatio;
      canvas_l3.style.width = dom_overlay_container_l3.style.width = anim_container_l3.style.width =  w*sRatio+'px';				
      canvas_l3.style.height = anim_container_l3.style.height = dom_overlay_container_l3.style.height = h*sRatio+'px';
      stage_l3.scaleX = pRatio*sRatio;			
      stage_l3.scaleY = pRatio*sRatio;			
      lastW = iw; lastH = ih; lastS = sRatio;		
    }
  }
  makeResponsive(false,'both',false,1);	
  fnStartAnimation_l3();
}
function init_l3() {
  canvas_l3 = document.getElementById("canvas_l3");
  anim_container_l3 = document.getElementById("animation_container_l3");
  dom_overlay_container_l3 = document.getElementById("dom_overlay_container_l3");
  images_l3 = images_l3||{};
  var loader = new createjs.LoadQueue(false);
  loader.addEventListener("fileload", handleFileLoad_l3);
  loader.addEventListener("complete", handleComplete_l3);
  loader.loadManifest(lib_l3.properties.manifest);
}


/***** Animation Setting *****/
const investmentAni = new TimelineMax({ paused: true });
const threeAni = new TimelineMax({ paused: true });
const pigsAni = new TimelineMax({ paused: true });
const pyramidAni = new TimelineMax({ paused: true });
const fluctuationAni = new TimelineMax({ paused: true });
const defenseAni = new TimelineMax({ paused: true });
const debtAni = new TimelineMax({ paused: true });
const rateAni = new TimelineMax({ paused: true });
const bondAni = new TimelineMax({ paused: true });
const fundAni = new TimelineMax({ paused: true });
const collectAni = new TimelineMax({ paused: true });
const qaAni = new TimelineMax({ paused: true });
var gaid = 'UA-75164793-3';
var fastscroll = false;

let hrefHashTag;
let THREE_ARR_LINE_WIDTH;
let PyramidTxt_WIDTH;
let PyramidArrow_HEIGHT;
(function() {
  // Investment (===== CANVAS times is 0.8 =====)
  const CANVAS_ANI_TIME = 0.9;
  if (winW >= 1024) {
    investmentAni
      .from('.investment .content > .img-wrap', 0.6, { opacity: 0, scale: 0.5})
      .staggerFrom(['.investment .highlight-word', '.investment .source-wrap'], 0.3, { y: -20, opacity: 0 }, 0.1, '-=0.2')
      // .staggerFrom('._investmentSlick .item', 0.45, { opacity: 0, onStart: function() {
      //   init_l1();
      //   init_l2();
      //   init_l3();
      // } }, 0.15, '-=0.8')
      .from('._investmentSlick .item-1', 0.45, { opacity: 0, onStart: function() {
        init_l1();
      } }, '-=0.8')
      .from('._investmentSlick .item-1 .img-wrap img, ._investmentSlick .item-1 .summary', 0.45, { opacity: 0 }, '+=' + CANVAS_ANI_TIME)
      .from('._investmentSlick .item-2', 0.45, { opacity: 0, onStart: function() {
        init_l2();
      } }, '-=1')
      .from('._investmentSlick .item-2 .img-wrap img, ._investmentSlick .item-2 .summary', 0.45, { opacity: 0 }, '+=' + (CANVAS_ANI_TIME - 1))
      .from('._investmentSlick .item-3', 0.45, { opacity: 0, onStart: function() {
        init_l3();
      } }, '-=1')
      .from('._investmentSlick .item-3 .img-wrap img, ._investmentSlick .item-3 .summary', 0.45, { opacity: 0 }, '+=' + (CANVAS_ANI_TIME - 1))
  } else {
    investmentAni
      .from('.investment .content > .img-wrap', 0.6, { opacity: 0, scale: 0.5 })
      .staggerFrom(['.investment .highlight-word', '._investmentSlick'], 0.3, { y: -20, opacity: 0 }, 0.15, '-=0.2')
  }



  // Pigs Animate
  const $pigsWrap = $('.pigs-wrap');
  const $pigs = $('.pig');
  const pigsWrapW = $pigsWrap.width();
  // const pigW = $('.pig').eq(2).width();
  
  const INTRO_S = 5;
  const PIGS_SHOW_HIDE_S = 0.3;
  const PIGS_HIDE_S = 0.6;
  let pigYear;
  
  function initPigYear() {
    pigYear=-1;
    $('.pigs h6 span').text(0);
  }
  function updatePigYear(year) {
    if (year) {
      pigYear = year;
    } else {
      pigYear += 1;
    }
    setTimeout(() => {
      $('.pigs h6 span').text(pigYear);
    }, 0.1);
  }

  if (winW >= 1024) {
    getThreeArrLineWidth();
    
    threeAni
      .from('.three .chart', 0.6, { opacity: 0 }, '+=0.3')
      .fromTo('.three .arr-line', 0.6, { opacity: 0, width: 0 }, { opacity: 1, width: THREE_ARR_LINE_WIDTH }, '-=0.4')
  } else {
    threeAni
      .fromTo('.three .arr-line', 1, { opacity: 0, width: 0 }, { opacity: 1, width: '100vw' })
  }
  
  pigsAni
    .staggerFrom(['.pigs .title > *', '.pigs > h6'], 0.4, { opacity: 0, y: -20 }, 0.2)
    .to($pigsWrap, INTRO_S, { x: pigsWrapW * -60 / 100, ease: Linear.easeNone, onStart: initPigYear }, '-=0.4')
    .to($pigsWrap, PIGS_SHOW_HIDE_S, { opacity: 1 }, '-=' + INTRO_S)
    .staggerTo($pigs, INTRO_S, {className:'+=active', onStart: updatePigYear }, 0.6, '-=4.1')
    .to($pigsWrap, PIGS_HIDE_S, { opacity: 0 }, '-=' + (INTRO_S -PIGS_HIDE_S))
    .to('.six-year', 1, { opacity: 1, onStart: function() { updatePigYear(6); } }, '-=' + (INTRO_S - PIGS_HIDE_S))
    
    
    
  getPyramidTxtWidth();
    if (winW >= 1024) {
      pyramidAni
        .from('.pyramid .pyramid_1', 0.6, { opacity: 0 },'+=0.3')
        .fromTo('.pyramid_txt .txt_1', 0.5, { width: 0 }, { width: PyramidTxt_WIDTH }, '-=0.5')
        .from('.pyramid .pyramid_2', 0.6, { opacity: 0 }, '+=0.1')
        .fromTo('.pyramid_txt .txt_2', 0.5, { width: 0 }, { width: PyramidTxt_WIDTH }, '-=0.2')
        .from('.pyramid .pyramid_3', 0.6, { opacity: 0 }, '-=0.1')
        .fromTo('.pyramid_txt .txt_3', 0.5, { width: 0 }, { width: PyramidTxt_WIDTH }, '-=0.2')
        .fromTo('.pyramid_arrow .arrow', 0.6, { height: 0 }, { height: PyramidArrow_HEIGHT }, '-=0.0') 
        .from('.pyramid_arrow .txt_top', 0.3, { opacity: 0 }, '+=0.0')
        .from('.pyramid_arrow .txt_bottom', 0.3, { opacity: 0 }, '-=0.3')
    } else {
        pyramidAni
        .from('.pyramid .pyramid_1', 0.6, { opacity: 0 },'+=0.3')
        .fromTo('.pyramid_txt .txt_1', 0.5, { width: 0 }, { width: PyramidTxt_WIDTH }, '-=0.5')
        .from('.pyramid .pyramid_2', 0.6, { opacity: 0 }, '+=0.1')
        .fromTo('.pyramid_txt .txt_2', 0.5, { width: 0 }, { width: PyramidTxt_WIDTH }, '-=0.2')
        .from('.pyramid .pyramid_3', 0.6, { opacity: 0 }, '-=0.1')
        .fromTo('.pyramid_txt .txt_3', 0.5, { width: 0 }, { width: PyramidTxt_WIDTH }, '-=0.2')
        .from('.pyramid_arrow .arrow', 0.6, { opacity: 0 }, '-=0.0') 
        .from('.pyramid_arrow .txt_top', 0.3, { opacity: 0 }, '+=0.0')
        .from('.pyramid_arrow .txt_bottom', 0.3, { opacity: 0 }, '-=0.3')
    }
  
  
  
  // FluctuationAni
  fluctuationAni
    .staggerFrom(['.fluctuation .title > *', '.fluctuation .topic'], 0.45, { y: -20, opacity: 0 }, 0.15)
    .from('.fluctuation .map .bg', 0.4, { opacity: 0, scale: 1.2, onStart: function() {
      $('.fluctuation .chart').addClass('active');
    }})
    .from('.fluctuation .map .line', 0.6, { opacity: 0 }, '-=0.4')
    .from('.fluctuation .map .wave', 0.8, { width: 0, opacity: 0, ease: Linear.easeNone }, '-=0.4')
    .from('.fluctuation .map .box-0', 0.43, { opacity: 0, ease: Linear.easeNone }, '-=0')
    .from('.fluctuation .map .box-1', 0.43, { opacity: 0, ease: Linear.easeNone }, '-=0') 
    .from('.fluctuation .map .box-2', 0.43, { opacity: 0, ease: Linear.easeNone }, '-=0')


  
  
  // Defense Animate
  const DEFENSE_ITEM_S = 0.15;
  const DEFENSE_ITEM_NUM = 3;
  const DEFENSE_LI_S = 0.06;
  const DEFENSE_LI_NUM = 8;
  if (winW >= 1024) {
    defenseAni
      .set('._defenseSlick li', { className: '' })
      .staggerFrom('._defenseSlick .item', DEFENSE_ITEM_S*DEFENSE_ITEM_NUM, { y: 20, opacity: 0 }, DEFENSE_ITEM_S)
      .staggerTo('._defenseSlick li', DEFENSE_LI_S*DEFENSE_LI_NUM, { className: '+=active' }, DEFENSE_LI_S, '-='+DEFENSE_ITEM_S*DEFENSE_ITEM_NUM)
    } else {
      // defenseAni
        // .staggerFrom('._defenseSlick .item', DEFENSE_ITEM_S*DEFENSE_ITEM_NUM, { y: 20, opacity: 0 }, DEFENSE_ITEM_S)
        // .staggerTo('._defenseSlick li', DEFENSE_LI_S*DEFENSE_LI_NUM, { className: '+=active' }, DEFENSE_LI_S, '-='+DEFENSE_ITEM_S*DEFENSE_ITEM_NUM)
  }

  
  const BOND_ITEM_S = 0.15;
  const BOND_ITEM_NUM = 3;
  const BOND_PAPER_S = 0.2;
  if (winW > 1024) {
    bondAni
      .staggerFrom('.bond .item', BOND_ITEM_S*BOND_ITEM_NUM, { opacity: 0, x: -20 }, BOND_ITEM_S)
      .staggerFrom('.bond .white-paper', BOND_PAPER_S*BOND_ITEM_NUM, { right: '90%' }, BOND_PAPER_S, '-=' + (BOND_ITEM_S*(BOND_ITEM_NUM)))
  } else {
    bondAni
      .staggerFrom('.bond .item', BOND_ITEM_S*BOND_ITEM_NUM, { opacity: 0, y: -20 }, BOND_ITEM_S)
      .staggerFrom('.bond .white-paper', BOND_PAPER_S*BOND_ITEM_NUM, { bottom: '100%' }, BOND_PAPER_S, '-=' + BOND_ITEM_S*(BOND_ITEM_NUM))
      .staggerFrom('.bond .white-paper > div:first-child p', BOND_PAPER_S*BOND_ITEM_NUM, { opacity: 0 }, BOND_PAPER_S, '-=' + BOND_ITEM_S*BOND_ITEM_NUM)
  }



  // Debt
//  debtAni
//    .from('.debt_center', .3, { scale: 0 }, '+=.3')
//    .from('.debt_left', .4, { scale: 0, transformOrigin: 'right center' }, '-=.2')
//    .from('.debt_right', .4, { scale: 0, transformOrigin: 'left center' }, '-=.4')
  debtAni
    .staggerFrom('.debt_item.item_1 .badge_box > *', .3, { x: -50, opacity: 0 }, .1, '+=.5')
    .from('.debt_item.item_1 .badge_label', .2, { scale: 0 }, '-=.1')
    .staggerFrom('.debt_item.item_2 .badge_box > *', .3, { x: -50, opacity: 0 }, .1, '+=.3')
    .from('.debt_item.item_2 .badge_label', .2, { scale: 0 }, '-=.1')

  // Rate
  rateAni
    .from('.rate_container', .4, { opacity: 0 }, '+=.3')
    .from('.rate .arrow_up', .4, { opacity: 0, y: 50 }, '-=.1')
    .from('.rate .arrow_left', .4, { opacity: 0, x: 50}, '+=.2')
    .from('.rate .target', .3, { scale: 0 }, '+=.1')
    .from('.rate .txt', .2, { scale: 0, transformOrigin: 'left center', onComplete: function(){
        TweenMax.to('.rate .targetImg', .3, { scale: 1.05, yoyo: true, repeat: -1 });
    }}, '-=.0') 
    

  // Fund
  const FUND_NUM = 11;
  const FUND_OFFSET = 0.1;
  fundAni
    .staggerFrom(['.fund .steps > picture', '.fund .btn'], FUND_OFFSET * FUND_NUM, { y: -20, opacity: 0 }, FUND_OFFSET)



  // Collect
  collectAni
    .staggerFrom('.collect .item', 0.6, { y: -20, opacity: 0 }, 0.2)
    .staggerTo('.collect .item', 0.3, { className: '+=active', ease: Power0.easeNone }, 0.1, '-=0.3')



  // Q&A
  qaAni
    .staggerFrom('.qa .item', 0.6, { opacity: 0, y: -20 }, 0.1)
})();
function waveAni() {
  const CSS_DURATION = 1000;
  const INTERVAL = 20;

  $.each($('.trend .columnar > div'), function(idx, el) {
    const $el = $(el);

    // Number
    let elNum = parseFloat($el.find('p').text());
    if (elNum > 0) return;
    elNum = parseFloat($el.data('num').toFixed(2));
    const gap = parseFloat((elNum / (CSS_DURATION / INTERVAL)).toFixed(2));
    //console.log(gap);
    
    let counter = 0;

    let timer = setInterval(() => {
      counter = parseFloat(counter + gap);
      
      if (parseFloat(counter.toFixed(2)) >= elNum) {
        counter = elNum;
        $el.find('p').text(counter.toFixed(2))
        clearInterval(timer);        
      }

      $el.find('p').text(counter.toFixed(2))
    }, INTERVAL);

    // Height
    const elH = parseFloat($el.data('h'));
    $el.height(`${elH}%`);
  });
}

/*==================== Variables ====================*/
let kvH;
let headerH;
let headerNavH;

/* Constant */
const DURATION = {
  FASTEST: 100,
  FAST: 150,
  FASTER: 200,
  STD: 300,
  NOR: 400,
  SLOWER: 500,
  SLOW: 600
};
const ACTIVE_NAME = 'active';

/* DOM */
const $header = $('.page-header');
const $fixedShare = $('.fixed-share');

/*==================================================*\
        Main Function
\*==================================================*/
function mainFunc() {
  /* window 事件: Resize & scroll */
  windowEvents();

  // 所有 Slick Carousel 初始化等高設定
  let understandSlickLock = false;
  $('._slick').on('init reInit setPosition', function() {
    letSlickSameHeight();
    setNavListRange();

    if ($(this).hasClass('_understandSlick') && !understandSlickLock) {
      $('.priority').removeClass('slick-current');
      understandSlickLock = true;
    }
  });
  const customArr = {
    prevArrow: '<button type="button" class="slick-prev"><img src="./images/icon/defense_prev_arr.png" alt="Previous Arrow"/></button>',
    nextArrow: '<button type="button" class="slick-next"><img src="./images/icon/defense_next_arr.png" alt="Next Arrow"/></button>',
  }

  /***** Investment *****/
  $('._investmentSlick').slick({
    dots: true,
    infinite: true,
    mobileFirst: true,
    ...customArr,
    responsive: [
      {
        breakpoint: 1024,
        settings: "unslick"
      }
    ]
  });

  /***** Understand *****/
  const $understandSlick = $('._understandSlick');

  $understandSlick.slick({
    dots: true,
    infinite: true,
    mobileFirst: true,
    prevArrow: '<button type="button" class="_brown-arr slick-prev"><img src="./images/icon/understand_prev_arr.png" alt="Previous Arrow"/></button>',
    nextArrow: '<button type="button" class="_brown-arr slick-next"><img src="./images/icon/understand_next_arr.png" alt="Next Arrow"/></button>',
  });

  $understandSlick.on('beforeChange', (event, slick, currentSlide, nextSlide) => {
    if (nextSlide === 0) {
      pyramidAni.play(0);
    }
    if (nextSlide === 1) {
      // if (winW >= 1024) {
      //   $('.pigs').removeClass('active');
      // }
      pigsAni.play(0);
    }
    if (nextSlide === 2) {
      if (winW >= 1024) {
        $('.three').removeClass('active');
      }
      threeAni.play(0);
    }
  });

  /***** Calm *****/
  $('._calmOwl').on('initialized.owl.carousel resize.owl.carousel', function() {
    const $owlItems = $('._calmOwl').find('.item');
    let max = 0;

    $owlItems.removeAttr('style');

    $.each($owlItems, (idx, el) => {
      const elHeight = $(el).height();
      
      if (elHeight > max) {
        max = elHeight;
      }
    })
    $.each($owlItems, (idx, el) => {
      $(el).height(max);
    })

    setNavListRange();
  });

  $('._calmOwl').owlCarousel({
    loop: true,
    center: true,
    dots: true,
    nav: true,
    autoWidth: true,
    navText: [
      `<img src="./images/icon/defense_prev_arr.png" alt="Previous Arrow"/>`,
      `<img src="./images/icon/defense_next_arr.png" alt="Next Arrow"/>`
    ],
    startPosition: 3,
    // responsive: {
    //   1024: {
    //     autoWidth: true,
    //   },
    // }
  });


  /***** Defense *****/
  $('._defenseSlick').slick({
    infinite: true,
    centerMode: true,
    initialSlide: 1,
    mobileFirst: true,
    ...customArr,
    responsive: [
      {
        breakpoint: 1024,
        settings: "unslick"
      }
    ]
  });

  /***** Q&A *****/
  const QA_ACTIVE_NAME = 'active';
  $('.qa button').on('click', function() {
    const $this = $(this).parent();
    const thisIdx = $this.index();

    if ($this.hasClass(QA_ACTIVE_NAME)) {
      $this.removeClass(QA_ACTIVE_NAME)
          .find('.ans').animate({
            height: 0
          }, DURATION.FASTER);
      return;
    }
    
    $('.qa .item').not($this).removeClass(QA_ACTIVE_NAME)
      .find('.ans').animate({
        height: 0
      }, DURATION.STD);

    $this.toggleClass(QA_ACTIVE_NAME)
      .find('.ans').animate({
        height: ansHList[thisIdx]
      }, DURATION.FASTER);
  });





  /***** Other Events *****/
  $('.page-header .list > a').not('.sns').on('click', function(evt) {
    evt.preventDefault();
	fastscroll = true;

    const anchor = $(this).data('anchor');
    let targetPos;

    if (anchor === 'kv') {
      targetPos = 0;
    } else {
      targetPos = winW < 1024 ?
      $(`.${anchor}`).offset().top - headerNavH + 1 :
      $(`.${anchor}`).offset().top - headerH + 1;
    }

    $('html, body').stop().animate({
      scrollTop: targetPos
    }, DURATION.STD, function(){
		fastscroll = false;
	});
  });

  $('.go-top').on('click', () => {
    $('html, body').stop().animate({
      scrollTop: 0
    }, DURATION.STD);
  });

  if (winW < 1024) {
    $('.fund-btn').on('click', function() {
      $('.steps').append(`
        <div class="btn-lb">
          <div class="content">
            <div class="img-wrap"></div>
            <div class="close-btn"></div>
          </div>
        </div>
      `);

      const $this = $(this);
      let NAME;
      if ($this.hasClass('manage')) {
        NAME = 'manage_content';
      } else if ($this.hasClass('recycle')) {
        NAME = 'recycle_content';
      }

      $('.btn-lb .content').addClass(NAME);
      $('.btn-lb .img-wrap').append(`
        <img src="./images/lb/${NAME}.png" alt=""/>
      `);

      $('.btn-lb, .btn-lb .close-btn').on('click', function() {
        $('.btn-lb').fadeOut(DURATION.STD, function() {
          $(this).remove();
        })
      });

      $('.btn-lb .content').on('click', function(evt) {
        evt.stopPropagation();
      });

      $('.btn-lb').fadeIn(DURATION.STD);
    });
  }
  
  
  $('.scroll-btn').on('click', () => {
    const scrollBtnObj = winW < 1024 ?
    {
      scrollTop: $('.investment').offset().top - headerNavH + 1
    } :
    {
      scrollTop: $('.investment').offset().top - headerH + 1
    };

    $('html, body').stop().animate(scrollBtnObj, DURATION.STD);
  });

  $('.calm .video a').lightbox();
  
  
  
  
  

  /* 收掉 .page-loading */
  const SECTION_LIST = ['outlook', 'three-point', 'skills', 'profiles', 'product', 'qa', 'qa-0',  'qa-1', 'qa-2', 'qa-3', 'qa-4', 'qa-5', 'qa-6'];
    setTimeout(function(){
  transitionThenRemove({
    dom: $(".page-loading"),
    duration: DURATION.SLOW,
    preback: () => {
        
      // Landing Hash Detect
      hrefHashTag = location.href.split('?')[1];
      if (!hrefHashTag) return;
      hrefHashTag = hrefHashTag.split('&');

      let hashTagPass = false;

      $.each(hrefHashTag, (index, element) => {
        $.each(SECTION_LIST, (idx, el) => {
          if (el === element) {
            hashTagPass = true;
            hrefHashTag = element;
          }
        });
      });

      if (hrefHashTag && hashTagPass) {
        const $target = $(`#${hrefHashTag}`);
        let offset = winW < 1024 ? headerNavH : headerH;
        if (hrefHashTag === 'three-point') offset -=1;

        if (hashTagDetect(hrefHashTag)) {
          offset += 11;
          qaAni.play(10);
          $target.find('button').click();
        }

        $('html, body').animate({
          scrollTop: $target.offset().top - offset
        }, DURATION.STD, function() {
          _resize();
          _scroll();
        });
      } 
    },
    callback: () => {
      console.log("%cBuild Completed!", logSafeStyle);
      scrollRangeDetect();    
    }
  });
        },1000);
}

function hashTagDetect(hrefHashTag) {
  const hashTagList = ['qa-0', 'qa-1', 'qa-2', 'qa-3', 'qa-4', 'qa-5', 'qa-6'];
  let ans = false;
  $.each(hashTagList, (idx, el) => {
    if (el === hrefHashTag) {
      ans = true;
    }
  })

  return ans;
}

function letSlickSameHeight() {
  const NOT_LIST = '._investmentSlick, ._understandSlick';
  $('._slick .item').removeAttr('height').css({ height: 'auto' });
  if (winW >= 1024) return;

  $.each($('._slick').not(NOT_LIST), (index, slick) => {
    const $slickItems = $(slick).find('.item');
    let max = 0;

    $.each($slickItems, (idx, el) => {
      const elHeight = $(el).height();
      
      if (elHeight > max) {
        max = elHeight;
      }
    })
    $.each($slickItems, (idx, el) => {
      $(el).height(max);
    })
  });
}

/*==================================================*\
        window Events
\*==================================================*/
let isFirstTime = true;
function windowEvents() {
  // Window Resize
  $win.on("resize", _resize).resize();
  // Window Scroll
  $win.on("scroll", _scroll).scroll();
}

/*========== Window Resize ==========*/
let ansHList = [];
function _resize() {
  getSize();
  setNavListRange();
  letSlickSameHeight();

  $('.qa .ans').removeAttr('style');
  $.each($('.qa .ans'), (idx, el) => {
    const thisH = $(el).outerHeight();
    ansHList.push(thisH);
  });
  $('.qa .item').not('.active').find('.ans').css({ height: 0 });
  $('.qa .active').find('.ans').css({ height: ansHList[$(this).index] });

  $('main').css({
    marginTop: winW < 1024 ? headerNavH : 0
  });
  
  if (winW < 1024) {
  } else {
    $header.removeClass('leave');
  }
}

function setNavListRange() {
  navListRange = [];

  $.each(navList, (idx, el) => {
    const $this = $(`#${el}`)
    //const $this = $(`.${el}`)
    let obj = {};


    obj.top = $this.offset().top === 0 ? 0 : $this.offset().top -1;
    obj.h = $this.height();
    obj.bottom = obj.top + obj.h;

    navListRange.push(obj);
  });
}

function getSize() {
  winW = $win.width();
  winH = $win.height();

  kvH = $('.kv').height();
  headerH = $header.outerHeight();
  headerNavH = $('.page-header nav').outerHeight();

  getThreeArrLineWidth();
    getPyramidTxtWidth();
}

function getThreeArrLineWidth() {
  // 1142 + (winW - 1142) / 2 
  const THREE_ARR_LINE_BASIC_NUMBER = 571 + $(window).width() / 2;

  if (winW < 1366) {
    THREE_ARR_LINE_WIDTH = THREE_ARR_LINE_BASIC_NUMBER + ($(window).width() * 0.03);
  } else {
    THREE_ARR_LINE_WIDTH = THREE_ARR_LINE_BASIC_NUMBER + 100;
  }
}

function getPyramidTxtWidth() {
  PyramidTxt_WIDTH = $('.pyramid_txt').width();
    $('.pyramid_txt img').width(PyramidTxt_WIDTH);
    if (winW >= 1024) {
        PyramidArrow_HEIGHT = PyramidTxt_WIDTH*0.8846761453396524;
    } else {
        PyramidArrow_HEIGHT = PyramidTxt_WIDTH*1.787375415282392;
    }
}

/*========== Window Scroll ==========*/
let nowPos;
const FIXED_SHARE_ACTIVE_NAME = '_white';
const HEADER_ACTIVE_NAME = 'leave';
function _scroll() {
  getPos();
  
  // <= 1024
  if (winW <= 1024) {

    if (nowPos.y > headerH && !$header.hasClass(HEADER_ACTIVE_NAME)) {
      $header.addClass(HEADER_ACTIVE_NAME);
    } else if (nowPos.y <= headerH && $header.hasClass(HEADER_ACTIVE_NAME)) {
      $header.removeClass(HEADER_ACTIVE_NAME);
    }
  }

  changeHeaderColor();
  changeFixedShareColor();
  scrollTriggerAni();
  scrollRangeDetect();
}

let qa1Lock = false;
const navList = ['outlook', 'three-point', 'skills', 'profiles', 'product', 'qa'];
//const navList = ['btn_menu00', 'btn_menu01', 'btn_menu02', 'btn_menu03', 'btn_menu04', 'btn_menu05'];
let navListRange = [];
let preIdx = -1;
const NAV_ACTIVE_NAME = 'active';
var passedPv = [];
function scrollRangeDetect() {
  let nowIdx = null;
  const pointLine = nowPos.y + (winW < 1024 ? headerNavH : headerH);

  $.each(navListRange, (idx, el) => {
    if (pointLine >= el.top && pointLine < el.bottom) {
      nowIdx = idx;
      return;
    }
  });

  if (nowIdx === preIdx || nowIdx === null || fastscroll) return;
  //if (nowIdx === preIdx || nowIdx === null) return;

  if(passedPv.indexOf(nowIdx) === -1) {
    passedPv.push(nowIdx);
    console.log('event', navList[nowIdx]);
    //gtag('config', gaid, {'page_title' : navList[nowIdx]});
    gtag('event', navList[nowIdx]);
  }

  if (navList[nowIdx] === 'qa' && !hrefHashTag && !qa1Lock) {
    $('#qa-0 button').click();
    qa1Lock = true;
  }

  preIdx = nowIdx;
  $('.page-header nav a').removeClass(NAV_ACTIVE_NAME).eq(nowIdx).addClass(NAV_ACTIVE_NAME);
}

// const $pigsChart = $('.pigs .chart');
const $earth = $('.earth');
function scrollTriggerAni() {
  // investment
  computeScrollRange($('.investment .content'), 'top') && investmentAni.play();

  // Three
  if (winW >= 1024) {
    if (computeScrollRange($('._understandSlick'))) { 
//      $('.pigs').addClass('active');
      pyramidAni.play();
    }
  } else { 
    computeScrollRange($('.understand .content')) && $('.priority').addClass('slick-current');
    if (computeScrollRange($('.understand .center'))) { 
        setTimeout(function(){
            pyramidAni.play();
        }, 1000);
    }
  }

  // Fluctuation
  computeScrollRange($('.fluctuation')) && fluctuationAni.play();

  // Cooperation
  computeScrollRange(winW > 1024 ? $earth : $('.cooperation'), 'top') && $earth.addClass('active');

  // Defense
//  if (winW >= 1024) {
//    computeScrollRange($('._defenseSlick')) && defenseAni.play();
//  }

  // Bond
  computeScrollRange($('.bond .container')) && bondAni.play();

  // Debt
  computeScrollRange($('.debt .container')) && debtAni.play();

  // Rate
  computeScrollRange($('.rate .container')) && rateAni.play();
  
  // Trend
//  computeScrollRange($('.trend .debt .chart'), 'bottom') && $('.trend .debt .line, .trend .debt .arr').addClass('active');
//  computeScrollRange($('.trend .wave .columnar > div'), 'bottom') && waveAni();
  
  // Fund
  computeScrollRange($('.fund .steps')) && fundAni.play();
  
  // Collect
  computeScrollRange($('.collect')) && collectAni.play();

  
  // Q&A
  if (winW >= 1024) {
    computeScrollRange($('.qa .container')) && qaAni.play();
  } else {
    computeScrollRange($('.qa .container'), 'top') && qaAni.play();
  }
}

function computeScrollRange($target, pos) {
  let posNum;

  switch (pos) {
    case 'top':
      posNum = 0;
      break;
    case 'bottom':
      posNum = $target.height();
      break;
    default:
      posNum = $target.height()/2;
      break;
  }

  return (nowPos.bottom > ($target.offset().top + posNum)
          &&
          nowPos.bottom <= ($target.offset().top + posNum + winH));
}

function getPos() {
  nowPos = {
    x: $win.scrollLeft(),
    y: $win.scrollTop(),
    bottom: $win.scrollTop() + winH
  };
}


function changeHeaderColor() {
  if (nowPos.y > $('.investment').offset().top - headerH && !$header.hasClass(ACTIVE_NAME)) {
    $header.addClass(ACTIVE_NAME);
  } else if (nowPos.y <= $('.investment').offset().top - headerH && $header.hasClass(ACTIVE_NAME)) {
    $header.removeClass(ACTIVE_NAME);
  }
}
function changeFixedShareColor() {
  if (nowPos.y <= kvH / 2 && !$fixedShare.hasClass(FIXED_SHARE_ACTIVE_NAME)) {
    $fixedShare.addClass(FIXED_SHARE_ACTIVE_NAME);
  } else if (nowPos.y > kvH / 2 && $fixedShare.hasClass(FIXED_SHARE_ACTIVE_NAME)) {
    $fixedShare.removeClass(FIXED_SHARE_ACTIVE_NAME);
  }
}


/*==================================================*\
        Library
\*==================================================*/
/* 斷點偵測 (for window resize) */
let preBP = { minimum: -1 };
function detectiveBreakpoint(breakpoint) {
  let nowBP = breakpoint[0];

  $.each(breakpoint, (idx, obj) => {
    const objName = Object.getOwnPropertyNames(obj)[0];
    const val = obj[objName];

    if (winW > val && val > nowBP[Object.getOwnPropertyNames(nowBP)[0]]) {
      nowBP = obj;
    }
  });

  if (
    Object.getOwnPropertyNames(nowBP)[0] ===
    Object.getOwnPropertyNames(preBP)[0]
  ) {
    return false;
  }

  // 執行 Media Query
  mediaQuery(nowBP);
}

// 執行 Media Query
function mediaQuery(nowBP) {
  const nowBPName = Object.getOwnPropertyNames(nowBP)[0];
  console.log(`Breakpoint {${nowBPName}: ${nowBP[nowBPName]}}`);

  // 執行該斷點 Media Query
  if (!nowBP.hasOwnProperty("mq")) {
    throw new Error(`此斷點(↑)尚未設定 Media Query 之屬性 "mq"(function)`);
  } else if (typeof nowBP.mq !== "function") {
    throw new Error(`此中斷點之 Media Query 型別並非 "function`);
  } else {
    nowBP.mq();
  }

  preBP = nowBP;
}

$('body').imagesLoaded().always(mainFunc);