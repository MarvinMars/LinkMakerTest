![Текст описания]([https://www.example.com/image.jpg](https://gregarious-taiyaki-d68f8e.netlify.app/images/Preview.png))
# Як запустити проект
Клонувати проект
```
git clone https://github.com/MarvinMars/LinkMakerTest.git
```
Зайти в проект та додати аліас для sail
```
cd LinkMakerTest
```
```
alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'
```
Запустити контейнер sail в демоні
```
sail up -d
```
Запустити тести
```
sail artisan config:clear
```
```
sail test
```
Запустити фронтенд частину
```
sail npm run dev
```
Перейти за адресою додатка APP_URL + роут створення нового посилання /links/create

e.g. http://localhost/links/create

```
  LARAVEL v11.2.0  plugin v1.0.2

  ➜  APP_URL: http://********
```
