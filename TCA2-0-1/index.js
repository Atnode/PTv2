(function() {
        //Initialization
        gdjs.registerObjects();
        gdjs.registerBehaviors();
        gdjs.registerGlobalCallbacks();

        var game = new gdjs.RuntimeGame(gdjs.projectData, {});

        //Create a renderer
        var canvasArea = document.getElementById("canvasArea");
        game.createStandardCanvas(canvasArea);

        //Bind keyboards/mouse/touch events
        game.bindStandardEvents(window, document);

        //Load all assets and start the game
        game.loadAllAssets(onAssetsLoaded);
        function onAssetsLoaded() {
            game.startStandardGameLoop();
        }
    })();