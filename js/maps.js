const dodo_pizza = "https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Ad0429d713780e5badffad980d8be9e08247755e77818e03428b0125d25389594&amp;width=500&amp;height=500&amp;lang=ru_RU&amp;scroll=true";
const gold__apple = "https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A98a487ad18c73c1ea9469b64d2da04642852ae2b2b0943087ad3f9e367a2b365&amp;width=500&amp;height=500&amp;lang=ru_RU&amp;scroll=true";


function dodo() {
    loadMap(dodo_pizza);
}

function gold_apple() {
    loadMap(gold__apple);
}

function loadMap(mapUrl) {
    // Очистка содержимого контейнера
    const container = document.getElementById("ymaps-container");
    while (container.firstChild) {
        container.removeChild(container.firstChild);
    }

    // Удаление текущего скрипта
    const oldScript = document.getElementById("ymaps-script");
    if (oldScript) {
        oldScript.remove();
    }

    // Создание нового скрипта
    const newScript = document.createElement('script');
    newScript.id = "ymaps-script";
    newScript.type = "text/javascript";
    newScript.charset = "utf-8";
    newScript.async = true;
    newScript.src = mapUrl;
    document.getElementById("ymaps-container").appendChild(newScript);
}

// Инициализация первой карты при загрузке страницы
window.onload = () => {
    loadMap(dodo_pizza);
};