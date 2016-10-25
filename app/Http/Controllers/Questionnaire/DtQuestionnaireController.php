<?php

namespace App\Http\Controllers\Questionnaire;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DtQuestionnaireController extends Controller
{
    private $questions = [];

    public function __construct()
    {
        $this->questions = json_decode('[{"_id":{"$oid":"580d82a484bb9d23d4dc2a16"},"number":"1","question":"以下对糖尿病的说法正确的是（  ）\n","answer":["A   糖尿病是一种以高血糖为特征的代谢性疾病\n","B\u0009高血糖是由于胰岛素分泌缺陷或其生物作用受损，或两者兼有引起\n","C\u0009人体器官长期浸泡在高血糖中，会损坏器官，并导致各种器官的并发症\n","D\u0009以上均对\n"],"right":"D","right_numer":"3"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a17"},"number":"2","question":"糖尿病可以根治吗？（ ）\n","answer":["A\u0009不可以。但现在的医疗手段是可以把血糖长期控制在正常范围内\n","B\u0009可以。现在社会已经这么发达了，完全可以根治\n"],"right":"A","right_numer":"0"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a18"},"number":"3","question":"以下对胰岛素的描述不正确的是（  ）\n","answer":["A\u0009胰岛素是人体自身分泌的唯一直接降低血糖的蛋白质\n","B\u0009当自身胰岛素分泌不足时，需及时补充外源性胰岛素以帮助血糖达标\n","C\u0009口服降糖药通过增加体内胰岛素分泌或增强胰岛素作用来降低血糖，不能代替胰岛素\n","D\u0009坚持服用口服药，不断增加口服药剂量就可以永远不用胰岛素\n"],"right":"D","right_numer":"3"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a19"},"number":"4","question":"积极的接受糖尿病教育可以帮助您（ ）\n","answer":["A\u0009获得正确糖尿病知识，转变不良生活方式\n","B\u0009提高自我管理糖尿病的能力，学会科学饮食、运动、正确监测、规范注射等\n","C\u0009早诊断、早治疗、早达标、早获益\n","D\u0009以上均是\n"],"right":"D","right_numer":"3"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a1a"},"number":"5","question":"注射胰岛素会成瘾？（ ）\n","answer":["A\u0009不会的。胰岛素是一种自身分泌的蛋白质，正常人身体内都有，没有成瘾性\n","B\u0009会的。一旦用上，就会上瘾\n","\n"],"right":"A","right_numer":"0"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a1b"},"number":"6","question":"第二代胰岛素的局限有哪些？（ ）\n","answer":["A\u0009不能模拟正常人生理胰岛素分泌模式\n","B\u0009需要餐前30分钟注射\n","C\u0009低血糖风险高\n","D\u0009以上均正确\n"],"right":"D","right_numer":"3"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a1c"},"number":"7","question":"第三代胰岛素—胰岛素类似物给患者带来哪些益处？（ ）\n","answer":["A\u0009血糖控制更好，低血糖风险更低\n","B\u0009体重优势逐渐凸显\n","C\u0009注射后可立即进餐，无需等待30分钟\n","D\u0009以上均正确\n"],"right":"D","right_numer":"3"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a1d"},"number":"8","question":"以下错误的注射部位是（ ）\n","answer":["A\u0009腹部\n","B\u0009大腿前侧和外侧\n","C\u0009上臂外侧\n","D\u0009臀部\n","E\u0009手臂内侧\n"],"right":"E","right_numer":"4"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a1e"},"number":"9","question":"注射胰岛素时需要捏皮吗？（ ）\n","answer":["A\u0009需要，在选择腹部注射时，除超重和肥胖患者可直接进针外，均需捏皮\n","B\u0009都不需要，直接进针即可\n","C\u0009可捏可不捏\n","\n"],"right":"A","right_numer":"0"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a1f"},"number":"10","question":"对于未启用的胰岛素产品，该如何保存(  )\n","answer":["A\u0009应放置在冷冻箱里冷冻起来，避免失效\n","B\u0009在一般室温下保存即可\n","C\u0009应放置在2°C-8°C冰箱冷藏室内储存，并严格遵循产品保质期。将胰岛素从冰箱取出后，须放置室温后使用。\n","D\u0009应放置在0°C-2°C冰箱冷藏室内储存，并严格遵循产品保质期。将胰岛素从冰箱取出后，须放置室温后使用。\n"],"right":"C","right_numer":"2"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a20"},"number":"11","question":"对于已开封的胰岛素产品，说法错误的是（ ）\n","answer":["A\u0009开封后的胰岛素可在一般室温下保存30天\n","B\u0009开封后的胰岛素需见光，最好日晒，从而保持胰岛素的活性\n","C\u0009正在使用的胰岛素不建议冷藏保存\n","D\u0009任何胰岛素产品都应避免冷冻\n"],"right":"B","right_numer":"1"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a21"},"number":"12","question":"糖尿病人不能吃水果，因为糖分太高。这种说法对吗？（ ）\n","answer":["A  正确，水果的热量太高，不利于糖尿病人控制体重\n","B  不正确，糖尿病人可以适量食用血糖指数低的水果，不要一口气吃完，应该多分几次吃。\n"],"right":"B","right_numer":"1"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a22"},"number":"13","question":"第3代速效胰岛素类似物或预混胰岛素类似物，应在餐前多长时间注射？\n","answer":["A  30分钟\n","B  15分钟\n","C  10分钟\n","D  餐前即可注射,无需等待\n","\n"],"right":"D","right_numer":"3"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a23"},"number":"14","question":"科学运动的好处，包括（）\n","answer":["A  增强体质，预约心情，提高生活质量\n","B  改善新陈代谢，减缓胰岛素抵抗，有助于降糖、降脂、降压\n","C  改善心血管系统和骨骼肌的功能，减少或预防并发症\n","D  以上都对\n"],"right":"D","right_numer":"3"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a24"},"number":"15","question":"运动的总原则是（）\n","answer":["A  在专业人员指导下进行运动\n","B  循序渐进，量力而行，持之以恒\n","C  以上都对\n"],"right":"C","right_numer":"2"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a25"},"number":"16","question":"下面不适合糖尿病人进行的运动是（）\n","answer":["A  快速短跑\n","B  步行\n","C  广场舞\n","D  瑜伽\n"],"right":"A","right_numer":"0"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a26"},"number":"17","question":"运动后应该尽快冲热水澡，放松身体的肌肉。这个说法正确吗？（ ）\n","answer":["A  正确，运动过程中会出很多的汗，身体肌肉也比较紧张，运动后应该尽快冲热水澡\n","B  不正确，运动后立刻洗热水澡会导致全身血液重新分配，导致脑部缺氧\n"],"right":"B","right_numer":"1"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a27"},"number":"18","question":"糖尿病人运动最怕出现低血糖，以下哪些措施不利于避免低血糖：（ ）\n","answer":["A  餐后1小时再运动\n","B  运动前服药需减量\n","C  空腹运动\n","D  随身携带糖果或者含糖饮料\n"],"right":"C","right_numer":"2"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a28"},"number":"19","question":"无论病情轻重，得了糖尿病都应该坚持运动。这个说法正确吗？（ ）\n","answer":["A  正确，运动对于任何糖尿病都是很好的治疗方法。\n","B  不正确，对于有严重并发症的糖尿病患者，需要在医务人员的指导下进行运动。\n"],"right":"B","right_numer":"1"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a29"},"number":"20","question":"中国2型糖尿病的综合控制目标中，糖化血红蛋白应该控制在：（ ）\n","answer":["A  \u003c4.4%\n","B  \u003c5%\n","C  \u003c7%\n","D  \u003c10%\n"],"right":"C","right_numer":"2"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a2a"},"number":"21","question":"只要身体感觉良好就行了，不用监测血糖。这个说法正确吗？（ ）\n","answer":["A  正确\n","B  不正确\n"],"right":"B","right_numer":"1"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a2b"},"number":"22","question":"坚持血糖监测，有哪些益处？（ ）\n","answer":["A  吃得更明白，知道哪些食物会引起较大的血糖波动\n","B  动得更安心，直观了解到运动对控糖的益处，易于坚持\n","C  遇到不适马上测血糖，防止低血糖发生\n","D  以上都对\n"],"right":"D","right_numer":"3"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a2c"},"number":"23","question":"对于2型糖尿病患者而言，以下的空腹血糖值哪个是达标的？\n","answer":["A  3.0-4.0mmol/L\n","B  7.0-10.0 mmol/L\n","C  4.4-7.0 mmol/L\n","D  5.1-7.5 mmol/L\n","\n"],"right":"C","right_numer":"2"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a2d"},"number":"24","question":"2型糖尿病控制的非空腹血糖值应是（ ）\n","answer":["A  10 mmol/L\n","B  13 mmol/L\n","C  14 mmol/L\n","D  15 mmol/L\n"],"right":"A","right_numer":"0"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a2e"},"number":"25","question":"胰岛素比口服药贵很多吗？（ ）\n","answer":["A 实践证明胰岛素的日治疗费用并不比口服药贵，甚至有时还会更便宜，合理使用胰岛素，可减少在糖尿病并发症上的花费\n","B 确实贵很多，不到万不得已不用胰岛素\n"],"right":"A","right_numer":"0"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a2f"},"number":"26","question":"下面哪种做法更适合于糖尿病患者（ ）\n","answer":["A  热水泡脚\n","B  穿松口袜\n","C  穿薄底布鞋\n"],"right":"B","right_numer":"1"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a30"},"number":"27","question":"发生糖尿病并发症的主要原因是（ ）\n","answer":["A 血糖长期不达标\n","B 患糖尿病超过10年\n","C 运动不够\n"],"right":"A","right_numer":"0"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a31"},"number":"28","question":"糖尿病并发症的信号描述正确的是（ ）\n","answer":["A 腰酸脚肿、水肿\n","B 高血压、视力正常但眼底检查异常\n","C 胃口不好，腹胀和便秘\n","D 以上均对\n","\n"],"right":"D","right_numer":"3"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a32"},"number":"29","question":"糖尿病患者出现哪种症状提示可能肾脏损伤（ ）\n","answer":["A  尿中泡沫增多\n","B  尿液发黄\n","C  腰痛\n"],"right":"A","right_numer":"0"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a33"},"number":"30","question":"糖尿病的治疗目的只是降低血糖，这种说法对吗？（ ）\n","answer":["A  正确，糖尿病仅仅控制血糖达标就可以了\n","B  不正确，糖尿病控制血糖的目的是防治并发症，所以还要降压调脂，控制体重等\n"],"right":"B","right_numer":"1"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a34"},"number":"31","question":"糖尿病患者用药期间，血糖低于多少就认为低血糖，需要及时处理（ ）\n","answer":["A  低于2.8 mmol/L\n","B  低于3.9 mmol/L\n","C  低于4.4 mmol/L\n","D  低于7.0 mmol/L\n"],"right":"B","right_numer":"1"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a35"},"number":"32","question":"以下那项不是低血糖的症状（ ）\n","answer":["A  发抖、冷汗\n","B  饥饿\n","C  心慌、焦虑不安\n","D  亢奋\n"],"right":"D","right_numer":"3"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a36"},"number":"33","question":"第3代胰岛素-胰岛素类似物相对于第2代胰岛素-人胰岛素在控制低血糖方面更好？（ ）\n","answer":["A 对，胰岛素类似物可以更好地防范低血糖风险，且安全性更好\n","B 不对，两者在控制低血糖方便相当\n"],"right":"A","right_numer":"0"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a37"},"number":"34","question":"一旦确定低血糖，请立即采取以下那种纠正（ ）\n","answer":["A  进食15-20克无脂碳水化合物\n","B  等15分钟测血糖\n","C  打电话寻求帮助\n","D  以上均对\n"],"right":"D","right_numer":"3"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a38"},"number":"35","question":"目前，胰岛素的种类包括（ ）\n","answer":["A  胰岛素增敏剂\n","B  GLP-1类似物\n","C  胰岛素类似物、 GLP-1类似物\n","D  动物胰岛素、人胰岛素、胰岛素类似物\n"],"right":"D","right_numer":"3"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a39"},"number":"36","question":"第一代胰岛素是（ ）\n","answer":["A  动物胰岛素\n","B  人胰岛素\n","C  胰岛素类似物\n","D  GLP-1类似物\n"],"right":"A","right_numer":"0"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a3a"},"number":"37","question":"第二代胰岛素-人胰岛素的局限有哪些？（ ）\n","answer":["A  低血糖风险相对高\n","B  需要餐前30分钟注射\n","C 不能模拟正常人生理胰岛素分泌模式\n","D  以上都对\n"],"right":"D","right_numer":"3"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a3b"},"number":"38","question":"关于胰岛素说法以下不正确的是（ ）\n","answer":["A  体内唯一能够降低血糖的激素\n","B  第二代胰岛素必须严格控制注射时间\n","C  第三代胰岛素使用方便，低血糖更少，血糖控制更好\n","D  能用口服药就一定不用胰岛素\n"],"right":"D","right_numer":"3"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a3c"},"number":"39","question":"糖尿病的全面管理包括（ ）\n","answer":["A  血糖达标\n","B  降低血压、血脂\n","C  控制体重\n","D  以上都是\n"],"right":"D","right_numer":"3"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a3d"},"number":"40","question":"糖尿病患者感觉好了就可以停药了吗？（ ）\n","answer":["A  可以，感觉好了就不再需要药物治疗了。\n","B  不可以，感觉好了不等于血糖控制好了，而且血糖控制是长期的，需要长期治疗，不能停药。\n"],"right":"B","right_numer":"1"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a3e"},"number":"41","question":"糖尿病确诊后患者提倡的做法是？（ ）\n","answer":["A  无所谓，继续以往的生活方式\n","B  消极悲观，抵触糖尿病的治疗\n","C  积极的面对，立即开始正规科学的糖尿病治疗\n","D  不认真对待，马马虎虎治疗\n"],"right":"C","right_numer":"2"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a3f"},"number":"42","question":"下面关于糖尿病治疗认识正确的是（ ）\n","answer":["A  目前糖尿病是不可治愈的疾病，要长期坚持治疗\n","B  目前糖尿病是可以治愈的疾病，没必要长期治疗\n","C  目前糖尿病是不可治愈的疾病，治不治都一样\n","D  目前糖尿病是可以治愈的疾病，只要血糖达标就可以停止治疗了\n"],"right":"A","right_numer":"0"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a40"},"number":"43","question":"下列糖尿病治疗的认识，正确的是（ ）\n","answer":["A  糖尿病一辈子都需要打针吃药，严重影响生活，活着没意思\n","B  糖尿病患者只要坚持科学的治疗和管理，完全可以和正常人一样生活工作\n"],"right":"B","right_numer":"1"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a41"},"number":"44","question":"糖尿病患者缓解压力的方法不正确的是？（ ）\n","answer":["A  经常进行适当的体育锻炼\n","B  可以多听舒缓的音乐放松\n","C  转移注意力到自己喜欢做的事情上\n","D  大吃大喝，放纵自己\n"],"right":"D","right_numer":"3"},
{"_id":{"$oid":"580d82a484bb9d23d4dc2a42"},"number":"45","question":"糖尿病的治疗包括（ ）\n","answer":["A  药物治疗\n","B  运动管理\n","C  饮食管理\n","D  心理管理\n","E  以上都对\n","\n"],"right":"E","right_numer":"4"}]
');
    $this->questions = collect($this->questions);
}


    public function questions() 
    {
        $questions = $this->questions;
        $random = $questions->random(5);

        return response()->json($random);
    }

    public function result()

    {

    }
}
