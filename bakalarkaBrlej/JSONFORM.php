<?php
$type = $_POST['questionType'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>To do</title>
    <script
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script>

        $(document).ready(function(){
            $.get("/bakalarkaBrlej/JSONFORMSERVICE.php", function(data,status){
                console.log(data);
                var toDoItems = JSON.parse(data);
                for(var i  = 0; i < toDoItems.length; i++){
                    var question = "questionId: " + toDoItems[i].questionId +
                        " question1: " + toDoItems[i].question1 +
                        " question2: " + toDoItems[i].question2 +
                    " question3: " + toDoItems[i].question3;
                    question = "<li>" + question + "<li>";
                    $("#myQuestions").append(question);
                }
            });
            $("#saveQuestions").click(function(){
                var question1 = $("#question1").val();
                var question2 = $("#question2").val();
                var question3 = $("#question3").val();

                var questions = {
                    question1 : question1,
                    question2 : question2,
                    question3 : question3
                };
                $.post("/bakalarkaBrlej/JSONFORMSERVICE.php", questions, function(data){
                    console.log(data);
                });
            });
        });
    </script>
</head>
<body>
<div>
    <h1>To Do list Items</h1>
    <li id="myQuestions">

    </li>
</div>
<div>
    <input type="hidden" name="questionType" value="<?php echo $type; ?>">
    <h2>Add New Item</h2>
    <label>question1</label>
    <input type="text" id="question1" /><br>
    <label>question2</label>
    <input type="text" id="question2"/><br>
    <label>question3</label>
    <input type="text" id="question3" /> <br>
    <input type="button" id="saveQuestions" value="Save Questions" />
</div>
</body>
</html>