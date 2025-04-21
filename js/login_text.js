// вывод ошибки в логине (возвращение к нормальному цвету текста)
document.getElementById('login').addEventListener('input', function() {
    this.style.color = 'black';
    this.placeholder = 'Логин';
  });
  
  document.getElementById('pass1').addEventListener('input', function() {
    this.style.color = 'black';
    this.placeholder = 'Пароль';
  });