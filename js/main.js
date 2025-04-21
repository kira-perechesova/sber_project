// плавная прокрутка меню
$(document).ready(function(){
    $('nav a[href^="#"]').click(function() {
        let target = $(this).attr('href');
        $('html, body').animate({
            scrollTop: $(target).offset().top
        },500);
        $('nav a[href^="#"]').parent().removeClass("active");
        $(this).parent().addClass("active");
        $('.menu__mobile .menu').toggle(500);
        $('.menu__burger').toggleClass('close');
        return false;
    });
    // мобильное меню
    $('.menu__burger').click(function(){
        $('.menu__mobile .menu').toggle(500);
        $(this).toggleClass('close');
    });
});



// отсчёт времени

const targetDate = new Date('2025-05-01 00:00:00');

// Функция для обновления таймера
function updateCountdown() {
  const now = new Date();
  const difference = targetDate - now;

  if (difference <= 0) {
    // Если время истекло, остановить таймер
    document.getElementById('days').textContent = '00';
    document.getElementById('hours').textContent = '00';
    document.getElementById('minutes').textContent = '00';
    clearInterval(timerInterval);
    return;
  }

  const days = Math.floor(difference / (1000 * 60 * 60 * 24));
  const hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  const minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));

  document.getElementById('days').textContent = String(days).padStart(2, '0');
  document.getElementById('hours').textContent = String(hours).padStart(2, '0');
  document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');

  document.getElementById('days_mobile').textContent = String(days).padStart(2, '0');
  document.getElementById('hours_mobile').textContent = String(hours).padStart(2, '0');
  document.getElementById('minutes_mobile').textContent = String(minutes).padStart(2, '0');
}

// Обновляем каждую минуту
const timerInterval = setInterval(updateCountdown, 1000);

// Первый вызов, чтобы избежать задержки
updateCountdown();



// меню (бургер)
function toggleMenu() {
    const burger = document.querySelector('.burger-icon');
    const mobileMenu = document.getElementById('mobileMenu');
    
    burger.classList.toggle('open');
    mobileMenu.classList.toggle('open');
}




// search (input)
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('pageSearchInput');
    
    searchInput.addEventListener('input', function() {
        const searchText = this.value.toLowerCase();
        if (searchText.length < 2) return; // Не ищем при слишком коротком запросе
        
        // Ищем по всем текстовым узлам на странице
        const walker = document.createTreeWalker(
            document.body,
            NodeFilter.SHOW_TEXT,
            null,
            false
        );
        
        let found = false;
        let node;
        
        // Сначала убираем предыдущие подсветки
        removeHighlights();
        
        while (node = walker.nextNode()) {
            if (node.nodeValue.toLowerCase().includes(searchText)) {
                highlightText(node.parentNode, searchText);
                found = true;
            }
        }
        
        if (found) {
            // Прокручиваем к первому найденному элементу
            const firstMatch = document.querySelector('.search-highlight');
            if (firstMatch) {
                firstMatch.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    });
    
    function highlightText(element, text) {
        const content = element.innerHTML;
        const regex = new RegExp(`(${text})`, 'gi');
        element.innerHTML = content.replace(regex, '<span class="search-highlight">$1</span>');
    }
    
    function removeHighlights() {
        const highlights = document.querySelectorAll('.search-highlight');
        highlights.forEach(highlight => {
            const parent = highlight.parentNode;
            parent.textContent = parent.textContent;
        });
    }
});

