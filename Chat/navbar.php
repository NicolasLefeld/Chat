<nav>
    <div class="nav-wrapper <?php echo $_SESSION['color_fondo']; ?> ">
        <a href="index.php" class="brand-logo center" style="font-family: Lobster;">
            ChatRoom
        </a>
        <ul class="left" style="width: 100%;">
            <li><a href="config.php"> <i class="material-icons">settings</i></a></li>
            <li><a href="perfil.php"><i class="material-icons">face</i> </a></li>
            <li id="chat_selection"><a href="#"><i class="material-icons">chat</i> </a></li>
            <li class="right"><a href="archivos_proceso/terminar_sesion.php"><i class="material-icons">exit_to_app</i> </a></li>
        </ul>
    </div>
</nav>