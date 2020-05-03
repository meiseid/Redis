var redis = require('redis');
var client = redis.createClient();

var lat = 35.729719;
var lng = 139.554424;
var rad = 2000;
var cnt = 5;

var argArray = ['ekipos', lng, lat, rad, 'm', 'WITHDIST', 'ASC'];
argArray.push('COUNT', cnt);

var hrstart = process.hrtime(); //計測開始
client.send_command('GEORADIUS_RO', argArray, function (err, reply) {
	var hrend = process.hrtime(hrstart); //計測終了
	var data = "GEORADIUS_RO ekipos " + lng + " " + lat + " " + rad + " " + "m" + " " + "WITHDIST" + " " + "COUNT" + " " + cnt + " " + "ASC" + "\n" +
	"関数実行時間 " + hrend[0] + "秒" + (hrend[1] / 1000000) + "ミリ秒\n";
	if(reply){
		var i,n = reply.length;
		data += "" + n + "個の駅が該当しました。\n";
		for(i = 0; i < n; i++ ){
			data += reply[i][1] + "M " + reply[i][0] + "\n";
		}
	}
	else if(err){
		data += err.toString();
	}
	process.stdout.write(data); //出力
	client.quit(); //どこかでquitしないとプロセスは終わらない
});
