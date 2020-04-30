<div id="sidebar" class="nav-collapse collapse">
    <div class="sidebar-toggler hidden-phone"></div>   
    <div class="navbar-inverse">
        <form class="navbar-search visible-phone">
             <input type="text" class="search-query" placeholder="Search" />
        </form>
    </div>
    <ul class="sidebar-menu">
    
        <li <?php if(isset($home)) echo $home;?>>
            <?=anchor(base_url(), '<span class="icon-box"><i class="icon-home"></i></span> Beranda');?>
        </li>

        <?php if ($this->auth->is_logged_in() == TRUE) { ?>
        
        <li <?php if(isset($db)) echo $db;?>>
            <?=anchor('dashboard', '<span class="icon-box"><i class="icon-dashboard"></i></span> Dashboard');?>
        </li>

        <li <?php if(isset($siswa)) echo $siswa;?>>
            <?=anchor('siswa/read', '<span class="icon-box"><i class="icon-signin"></i></span> PPDB '.config('ppdb_tahun'));?>
        </li>
        
        <li <?php if(isset($laporan)) echo $laporan;?>>
            <?=anchor('laporan', '<span class="icon-box"><i class="icon-bar-chart"></i></span> Laporan');?>
        </li>        

        

        <li class="has-sub <?php if(isset($master)) echo $master;?>">
            <a href="javascript:;" class="">
                <span class="icon-box"> <i class="icon-tasks"></i></span> Data Master
                <span class="arrow"></span>
            </a>
            <ul class="sub">
                <li <?php if(isset($pk)) echo $pk;?>><?=anchor('pekerjaan', 'Pekerjaan');?></li>
                <li <?php if(isset($pd)) echo $pd;?>><?=anchor('prodi', 'Program Studi');?></li>
                <li <?php if(isset($pc)) echo $pc;?>><?=anchor('post_category', 'Post Category');?></li>
                <li <?php if(isset($lc)) echo $lc;?>><?=anchor('link_category', 'Link Category');?></li>
            </ul>
        </li>
                
        <li <?php if(isset($posts)) echo $posts;?>>
            <?=anchor('post/read', '<span class="icon-box"><i class="icon-edit"></i></span> Posts');?>
        </li>
        
        <li <?php if(isset($lk)) echo $lk;?>>
            <?=anchor('link', '<span class="icon-box"><i class="icon-link"></i></span> Link');?>
        </li>

        <li class="has-sub <?php if(isset($tools)) echo $tools;?>">
            <a href="javascript:;" class="">
                <span class="icon-box"><i class="icon-wrench"></i></span> Tools
                <span class="arrow"></span>
            </a>
            <ul class="sub">
                <li <?php if(isset($cg)) echo $cg;?>><?=anchor('configuration/index/1', 'Configuration');?></li>
                
                <?php if ($this->session->userdata('user_level') == 1) { ?>
                <li <?php if(isset($us)) echo $us;?>><?=anchor('users', 'Users Management');?></li>
                <li><?=anchor('dashboard/backup', 'Backup Database');?></li>
                <?php } ?>
                
                               
            </ul>
        </li>
        <?php } else { ?>

        <li class="has-sub <?php if(isset($ppdb)) echo $ppdb;?>">
            <a href="javascript:;" class="">
               <span class="icon-box"> <i class="icon-signin"></i></span> PPDB <?=config('ppdb_tahun');?>
               <span class="arrow"></span>
            </a>
            <ul class="sub">
                <li <?php if(isset($daftar)) echo $daftar;?>><?=anchor('siswa/create', 'Daftar Sekarang');?></li>
                <li <?php if(isset($seleksi)) echo $seleksi;?>><?=anchor('siswa/hasil_seleksi', 'Hasil Seleksi');?></li>
                <li <?php if(isset($cetak)) echo $cetak;?>><?=anchor('siswa/cetak_formulir', 'Cetak Formulir');?></li>
            </ul>
        </li>
        
          
        
        
        <?php } ?>
    </ul>
</div>