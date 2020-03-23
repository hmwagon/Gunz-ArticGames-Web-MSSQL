<article class="module width_full">
			<header><h3>Stats</h3></header>
			<div class="module_content">
				<article class="stats_graph">
		<p align="left"><font style="color: #000">Cuentas Creadas: <strong>
    <?php
	$query = odbc_exec($connection, "SELECT COUNT(*) FROM {$_CONFIG[AccountTable]}(nolock)");
    odbc_fetch_row($query);
    echo odbc_result($query, 1);
    ?>
    </font></strong><font style="color: #000"><br />Personajes Creados: <strong>
    <?php
    $query = odbc_exec($connection, "SELECT COUNT(*) FROM {$_CONFIG[CharTable]}(nolock)");
    odbc_fetch_row($query);
    echo odbc_result($query, 1);
    ?>
    
        </font></strong><font style="color: #000"><br />Clanes Creados: <strong>
    <?php
    $query = odbc_exec($connection, "SELECT COUNT(*) FROM {$_CONFIG[ClanTable]}(nolock)");
    odbc_fetch_row($query);
    echo odbc_result($query, 1);
    ?>
    
    
    </font></strong><font style="color: #000"><br />Jugadores Online: <strong>
    <?php
    $query = odbc_exec($connection, "SELECT CurrPlayer FROM ServerStatus(nolock) WHERE Opened != 0");
    $count = 0;
    while( odbc_fetch_row($query) )
    {
        $count = $count + odbc_result($query, 1);
    }
    echo $count;
    ?>
    </font></strong></p>
    <p align="left"><strong><font style="color: #000">Estado<br />
    <?php
    $query = odbc_exec($connection, "SELECT * FROM ServerStatus(nolock) WHERE Opened != 0");
    while( $data = odbc_fetch_object($query) )
    {

		echo $data->ServerName."<font style='color: #009933'><B> Online</B></font>";
		
    }
    ?>
   </font> </strong></p>
				</article>
				
				<article class="stats_overview">
					<div class="overview_today">
						<p class="overview_day">Hoy</p>
						<p class="overview_count">0</p>
						<p class="overview_type">Donate</p>
						<p class="overview_count">0$</p>
						
					</div>
					<div class="overview_previous">
						<p class="overview_day">Ayer</p>
						<p class="overview_count">0</p>
						<p class="overview_type">Donate</p>
						<p class="overview_count">0$</p>
						
					</div>
				</article>
				<div class="clear"></div>
			</div>
		</article>

		

		


		