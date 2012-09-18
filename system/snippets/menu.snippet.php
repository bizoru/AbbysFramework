          <div id="menu">
                <h2>Your First Module</h2>
                <ul>
                    <li><?php image('house.png') ?><?php lnk("@home",'Start') ?></li>
                </ul>
                <div class="cerrar sesion">
                    <form action="<?php submit_to('backend', 'login', 'logout'); ?>" method="get">
                        <input type="submit" value="Logout" />
                    </form>
                </div>
            </div>