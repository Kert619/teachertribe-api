<?php

namespace Database\Seeders;

use App\Models\Problem;
use App\Models\ProblemType;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProblemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dateNow = Carbon::now();
        $htmlProblemTypeId = ProblemType::where('problem_type','HTML Problem 1')->first()->id;
        $cssProblemTypeId = ProblemType::where('problem_type','CSS Problem 1')->first()->id;
        $javascriptProblemTypeId = ProblemType::where('problem_type','Javascript Problem 1')->first()->id;

        $htmlProblems = [
            ['problem_title' => 'Noughts and Crosses', 'problem_type_id' => $htmlProblemTypeId, 'difficulty' => 'Medium', 'duration' => 30, 'instructions' => '<p><strong>Write an HTML code snippet that will contain the following HTML elements:&nbsp;</strong></p><p><br></p><p>1. An h1 heading written as "Noughts and crosses" with the text aligned at center </p><p>2. A table with border = “1”, width = “100%” and id = “mytable” </p><p>3. The table will contain three rows and three columns </p><p>4. Each cell in the table will contain a centralized figure tag</p><p>5. Each figure tag will have inline style attributes that will create a box </p><p>6. Each box will have a 200 px x 200 px dimension </p><p>7. Each box will have a gray background color </p><p>8. Each box will have a black solid border of 1px </p><p>9. The middle box (row 2 and column 2) will have a letter “X” with font-size = 100px </p><p><br></p><p><strong>The code snippet should have the following structure:&nbsp;&nbsp;</strong></p><p><br></p><p>&lt;html&gt;</p><p>&lt;body&gt;</p><p>&lt;!-- your code here --&gt;</p><p>&lt;/body&gt;</p><p>&lt;/html&gt;</p>', 'score' => 20, 'created_at' => $dateNow, 'updated_at' => $dateNow],
            ['problem_title' => 'General HTML', 'problem_type_id' => $htmlProblemTypeId, 'difficulty' => 'Low', 'duration' => 30, 'instructions' => "<p><strong>Write an HTML code snippet, which will contain the below-given HTML elements.&nbsp;</strong></p><p><br></p><p>1. A text with 'h1' heading written as: \"Page Title\" </p><p>2. A text written in italic: \"page body\" </p><p>3. A table with two rows. The details of each row are as follows: a. First row will contain \"C11\" and \"C12\" as data b. Second row will contain \"C21\" and \"C22\" as data </p><p>4. A date input with name \"bday\" </p><p>5. A color input with name \"icolor\" </p><p>6. A number input with min 10 and max 12 </p><p>7. A search input with name \"searchengine\" </p><p>8. A text \"Heading\" within 'h2' tag, with background color rgb(30,30,255) </p><p>9. A link with url \"url\" and text \"link url\" </p><p>10. An unordered list with three items: a. A b. B c. C </p><p><br></p><p>The code snippet should have the following structure:</p><p><br></p><p>&lt;html&gt;</p><p>&lt;body&gt;</p><p>&lt;!-- your code goes here --&gt;</p><p>&lt;/body&gt;</p><p>&lt;/html&gt;</p>",'score' => 10, 'created_at' => $dateNow, 'updated_at' => $dateNow],
            ['problem_title' => 'UNIVERSAL', 'problem_type_id' => $cssProblemTypeId, 'difficulty' => 'High', 'duration' => 30, 'instructions' => '<p><strong>Write CSS rules as per following requirements:</strong></p><p><br></p><p>1. All elements should have the following properties:</p><p>a. Margin of 0px </p><p>b. Padding of 2px&nbsp;</p><p><br></p><p>2. All elements within div with id ‘div1’ should have the following properties:</p><p>a. Color red rgb(255,0,0)&nbsp;</p><p>b. Display block</p><p>c. Background color green rgb(0,128,0)</p><p><br></p><p>3. A paragraph (‘p’ tag) immediately following a div with id ‘div1’ should have the following properties:</p><p>a. Font weight bold </p><p>b. Color green rgb(0,128,0) </p><p>c. Background color red rgb(255,0,0)</p><p><br></p><p>4. A paragraph (‘p’ tag) immediately nested to a div with id ‘div2’ should have the following properties:</p><p>a. Color yellow rgb(255,255,0)</p><p>b. Background color blue rgb(0,0,255)</p><p><br></p><p><strong style="color: rgb(0, 0, 0);">Note</strong><span style="color: rgb(0, 0, 0);">: You are </span><strong style="color: rgb(0, 0, 0);">NOT </strong><span style="color: rgb(0, 0, 0);">required to type the style tags (). You are just required to write the CSS rules. For example: </span>font{ color:rgb(12,13,14) }&nbsp;</p>','score' => 30, 'created_at' => $dateNow, 'updated_at' => $dateNow],
            ['problem_title' => 'Integers Sum', 'problem_type_id' => $javascriptProblemTypeId, 'difficulty' => 'Medium', 'duration' => 30, 'instructions' => "<p>Write a function sum that will receive a variable number of integer arguments and will return the sum of all of them.</p><p><br></p><p>For example, sum(1) should return 1. On the other hand, something like sum(1,2,3) should return 6. If no arguments are supplied, your function should return 0.</p><p><br></p><p><strong>The solution should be written in the following format:</strong></p><p><br></p><p>function sum(){</p><p><br></p><p>}</p><p><br></p><p><strong>Note 1:</strong> You are not required to parse the arguments.&nbsp;</p><p><strong>Note 2:</strong> You are not required to insert the script tags, i.e., there's no need to add</p><p>&lt;script type=\"text/javascript\"&gt;&lt;/script&gt;</p>",'score' => 20, 'created_at' => $dateNow, 'updated_at' => $dateNow],
        ];

        Problem::insert($htmlProblems);
    }
}
