gdjs.MenuCode = {};


gdjs.MenuCode.GDLogoObjects1= [];
gdjs.MenuCode.GDNouvelObjetObjects1= [];

gdjs.MenuCode.conditionTrue_0 = {val:false};
gdjs.MenuCode.condition0IsTrue_0 = {val:false};
gdjs.MenuCode.condition1IsTrue_0 = {val:false};

gdjs.MenuCode.func = function(runtimeScene, context) {
context.startNewFrame();
gdjs.MenuCode.GDLogoObjects1.length = 0;
gdjs.MenuCode.GDNouvelObjetObjects1.length = 0;


{


gdjs.MenuCode.condition0IsTrue_0.val = false;
{
gdjs.MenuCode.condition0IsTrue_0.val = gdjs.evtTools.input.isKeyPressed(runtimeScene, "Return");
}if (gdjs.MenuCode.condition0IsTrue_0.val) {
{gdjs.evtTools.runtimeScene.changeScene(runtimeScene, "Jeu");
}}

}

return;
}
gdjs['MenuCode']= gdjs.MenuCode;
