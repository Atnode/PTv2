gdjs.GameOverCode = {};


gdjs.GameOverCode.GDNouvelObjetObjects1= [];
gdjs.GameOverCode.GDTonScoreObjects1= [];

gdjs.GameOverCode.conditionTrue_0 = {val:false};
gdjs.GameOverCode.condition0IsTrue_0 = {val:false};
gdjs.GameOverCode.condition1IsTrue_0 = {val:false};

gdjs.GameOverCode.func = function(runtimeScene, context) {
context.startNewFrame();
gdjs.GameOverCode.GDNouvelObjetObjects1.length = 0;
gdjs.GameOverCode.GDTonScoreObjects1.length = 0;


{


gdjs.GameOverCode.condition0IsTrue_0.val = false;
{
gdjs.GameOverCode.condition0IsTrue_0.val = gdjs.evtTools.runtimeScene.sceneJustBegins(runtimeScene);
}if (gdjs.GameOverCode.condition0IsTrue_0.val) {
{gdjs.evtTools.sound.playMusicOnChannel(runtimeScene, "GameOver.ogg", 1, false, 100, 1);
}{gdjs.evtTools.runtimeScene.resetTimer(runtimeScene, "GameOver");
}}

}


{


gdjs.GameOverCode.condition0IsTrue_0.val = false;
{
gdjs.GameOverCode.condition0IsTrue_0.val = gdjs.evtTools.runtimeScene.timerElapsedTime(runtimeScene, 7.5, "GameOver");
}if (gdjs.GameOverCode.condition0IsTrue_0.val) {
{gdjs.evtTools.runtimeScene.replaceScene(runtimeScene, "TitleScreen", false);
}}

}


{

gdjs.GameOverCode.GDTonScoreObjects1.createFrom(runtimeScene.getObjects("TonScore"));

{for(var i = 0, len = gdjs.GameOverCode.GDTonScoreObjects1.length ;i < len;++i) {
    gdjs.GameOverCode.GDTonScoreObjects1[i].setString("Ton score : "+gdjs.evtTools.common.getVariableString(runtimeScene.getGame().getVariables().get("Score")));
}
}
}

return;
}
gdjs['GameOverCode']= gdjs.GameOverCode;
