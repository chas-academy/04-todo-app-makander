<header class="header">
    <h1>todos</h1>
    <form id="create-todo" method="post" action="todos">
        <input name="title" class="new-todo" placeholder="What needs to be done?" autofocus>
    </form>
</header>

<section class="main">
    <form method="post" action="todos/toggle-all">
        <?php count(array_filter($todos, function ($todo) {
    if ($todo['completed'] === "false") {
        $todo['completed'] = "true";
    }
})); ?>
        <input id="toggle-all" name="completed" class="toggle-all" type="checkbox" onChange="submit();">



        <label for="toggle-all">Mark all as complete</label>
    </form>
</section>