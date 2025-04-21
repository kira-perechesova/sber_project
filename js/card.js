$(document).ready(function() {
    // Устанавливаем начальный z-index и margin-top для всех контейнеров
    $(".card_container").each(function() {
        $(this).css({
            "z-index": 0,
            "margin-top": "0px" // Начальное значение margin-top
        });
    });

    // При клике на элемент с классом card_container
    $(".card_container").click(function() {
        // Сбросить z-index и margin-top для всех элементов
        $(".card_container").css({
            "z-index": 1,
            "margin-top": "0px"
        });
        
        // Установить высокий z-index и margin-top для выбранного элемента
        $(this).css({
            "z-index": 10,
            "margin-top": "200px"
        });    
    });
});