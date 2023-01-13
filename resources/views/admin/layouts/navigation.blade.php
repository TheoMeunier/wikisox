<nav class="admin__navbar">
    <div class="admin__navbar__start">
        <logo></logo>
        <p class="h3">IsoxBook</p>
    </div>
    <div class="admin__navbar__end">
        <ul>
            <li>{{ auth()->user()->name }}</li>
        </ul>
    </div>
</nav>
