<!--Logo-->
<div class="menu_logo">
    <a href="index.php"><img src="IMDb2.png" alt="logo1" class="menu_logo"/> </a>
</div>
<!--Kereses-->
<div class="menu_search">
<form name="searchform" method = "POST" action = "founded.php">
    <table cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td>
                    <input style="padding:0 0 0 7px;font-size:12px;font-weight:bold;color:#323232;height:30px;width:25vw;
                    border:0 none;background-color:white;box-shadow:gray 2px 3px 3px inset;" type="text" name="keresett" placeholder="Kérlek írd be azt a filmet amit keresel!">
                </td>
                <td>
                    <input style="height: 30px; width: 33px; background: url('searchbar_btn.png') top left no-repeat; border: 0px none; font-size: 1px; line-height: 1px; cursor: pointer" type="submit" name="submit" title="" value=" ">
                </td>
            </tr>
        </tbody>
    </table>
    <div class = "gombok">
    <label class="container">
    <input name="kategori[]" type="checkbox" value="Akcio">Akció 
    <span class="checkmark"></span>
    </label>
    <label class="container">
    <input name="kategori[]" type="checkbox" value="Sci-Fi">Sci-Fi 
    <span class="checkmark"></span>
    </label>
    <label class="container">
    <input name="kategori[]" type="checkbox" value="Vigjatek">Vígjáték 
    <span class="checkmark"></span>
    </label>
    <label class="container">
    <input name="kategori[]" type="checkbox" value="Haborus">Háborús 
    <span class="checkmark"></span>
    </label>
    <label class="container">
    <input name="kategori[]" type="checkbox" value="Fantasy">Fantasy 
    <span class="checkmark"></span>
    </label>
    <label class="container">
    <input name="kategori[]" type="checkbox" value="Thriller">Thriller 
    <span class="checkmark"></span>
    </label>
    <label class="container">
    <input name="kategori[]" type="checkbox" value="Drama">Dráma 
    <span class="checkmark"></span>
    </label>
    </div>
    </form>
</div>