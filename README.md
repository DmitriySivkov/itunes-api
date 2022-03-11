<h1>Abelohost тестовое</h1>
<p>
    <ol>
        <li>настройки в env-е для соединения с БД:
            <p>DB_CONNECTION=pgsql</p>
            <p>DB_HOST=pg</p>
            <p>DB_PORT=5432</p>
            <p>DB_DATABASE=abelohost_db</p>
            <p>DB_USERNAME=root</p>
            <p>DB_PASSWORD=root</p>
        </li>
        <li>для старта докера стандартное - docker-compose up</li>
        <li>докер висит на порту 8080</li>
        <li>для входа в php контейнер можно использовать команду из makefile: make php_container</li>
        <li>для сборки фронта, например, quasar dev</li>
        <li>фронт висит на порту 8081</li>
    </ol>
    