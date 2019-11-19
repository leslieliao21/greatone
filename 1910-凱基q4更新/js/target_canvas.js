//@prepros-prepend _canvas.js

var canvas, stage, exportRoot, anim_container, dom_overlay_container, fnStartAnimation;
                    $(function(){
                    function init() {
                        canvas = document.getElementById("canvas");
                        anim_container = document.getElementById("animation_container");
                        dom_overlay_container = document.getElementById("dom_overlay_container");
                        var comp = AdobeAn.getComposition("A0F04536A8EC8D46ACEA9D745A0554EF");
                        var lib = comp.getLibrary();
                        var loader = new createjs.LoadQueue(false);
                        loader.installPlugin(createjs.Sound);
                        loader.addEventListener("complete", function(evt) {
                            handleComplete(evt, comp)
                        });
                        var lib = comp.getLibrary();
                        loader.loadManifest(lib.properties.manifest);
                    }

                    function handleComplete(evt, comp) {
                        //This function is always called, irrespective of the content. You can use the variable "stage" after it is created in token create_stage.
                        var lib = comp.getLibrary();
                        var ss = comp.getSpriteSheet();
                        var queue = evt.target;
                        var ssMetadata = lib.ssMetadata;
                        for (i = 0; i < ssMetadata.length; i++) {
                            ss[ssMetadata[i].name] = new createjs.SpriteSheet({
                                "images": [queue.getResult(ssMetadata[i].name)],
                                "frames": ssMetadata[i].frames
                            })
                        }
                        exportRoot = new lib._1160x600();
                        stage = new lib.Stage(canvas);
                        //Registers the "tick" event listener.
                        fnStartAnimation = function() {
                            stage.addChild(exportRoot);
                            createjs.Ticker.setFPS(lib.properties.fps);
                            createjs.Ticker.addEventListener("tick", stage);
                        }
                        //Code to support hidpi screens and responsive scaling.
                        AdobeAn.makeResponsive(false, 'both', false, 1, [canvas, anim_container, dom_overlay_container]);
                        AdobeAn.compositionLoaded(lib.properties.id);
                        fnStartAnimation();
                    }

                    function playSound(id, loop) {
                        return createjs.Sound.play(id, createjs.Sound.INTERRUPT_EARLY, 0, 0, loop);
                    }
                    init();
                        });