using System;
using System.IO;
using System.Collections.Generic;
using System.Linq;
public class Test
{
    private string directory = @"./quests.txt";
    private List<Question> questions = new List<Question>();
    private int actualQuest = 0;
    private int mark = 0;

    public void LoadQuests()
    {
        List<string> AllText = File.ReadAllText(directory).Split("\n").ToList();
            List<string> awnsers = new List<string>();
            string question = "";
            string correct = "";
            string mark = "";
            int round = 0;
        for(int i=0;i<AllText.Count;i++){
            if(AllText[i].IndexOf("; P;") != -1){
                question = AllText[i].Remove(0,4);
            } else if(AllText[i].IndexOf("; R;") != -1){
                correct = AllText[i];
            } else if(AllText[i].IndexOf("Option") != -1){
                awnsers.Add(AllText[i]);
            } else if(AllText[i].IndexOf("Points") != -1){
                mark = AllText[i].Remove(AllText[i].IndexOf("Points "),7);
                round = 1;
            }
            if(round == 1){
                if(awnsers.Count <= 4 && awnsers.Count >= 2 && Convert.ToInt32(correct.Remove(0,4)) <= awnsers.Count && mark.IndexOf('.') == -1 &&  mark.IndexOf(',') == -1){
                    this.questions.Add(new Question(question,mark,new Options(awnsers,correct)));
                }
                awnsers = new List<string>();
                question = "";
                correct = "";
                mark = "";
                round = 0;
            }
        }
    }

    public int NextQuest(){
        int x = -2;
        if(this.actualQuest > this.questions.Count){
            Console.WriteLine("You finished the test!");
        } else {
            this.questions[actualQuest].ShowQuest();
            List<string> tmp = this.questions[actualQuest].GetOptions().GetOptions();
            for(int i=0;i<tmp.Count;i++){
                Console.WriteLine(tmp[i]);
                x = i;
            }
        }
        return x;
    }

    public void TestAwnser(int awnser){
        Options options = this.questions[this.actualQuest].GetOptions();
        if(awnser == options.GetCorrect()){
            mark += this.questions[this.actualQuest].GetPoints();
        }
        this.actualQuest+=1;
    }

    public void StartTest(){
        this.LoadQuests();
    }
    
    public void RestartTest(){
        this.actualQuest = 0;
        this.mark = 0;
    }

    public int GetQuestionLength(){
        return this.questions.Count;
    }
    
    public int GetMark(){
        return this.mark;
    }
    
    public int GetMaxMark(){
        int maxMark = 0;
        for(int i=0;i<this.questions.Count;i++){
            maxMark += this.questions[i].GetPoints();
        }   
        return maxMark;
    }
}