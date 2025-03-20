<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <button type="button" onclick="decreaseValue()" name="decrease">-</button>
        <input type="number" id="amount" name="amount" value="1">
        <button type="button" onclick="increaseValue()" name="increase">+</button>
    </form>

    <script>
        function decreaseValue(){
            let inputElement = document.getElementById('amount');
            let currentValue = parseFloat(inputElement.value);

            if(currentValue > 1){
                let newValue = currentValue - 1;
                inputElement.value = newValue;
            }
        }

        function increaseValue(){
            let inputElement = document.getElementById('amount');
            let currentValue = parseFloat(inputElement.value);

            if(currentValue < 20){
                let newValue = currentValue + 1;
                inputElement.value = newValue;
            }
        }
    </script>
</body>
</html>
