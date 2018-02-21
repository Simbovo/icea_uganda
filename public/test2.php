<?php
error_reporting(1);
session_start();
include('aardb_conn.php');
include('functions.php');


global $session, $database, $Fundfname, $functions;
$Fundfname = $_GET['fname'];
?>


<!doctype html>

<html lang="en-US">
    <head>
        <meta charset="UTF-8"/>
        <title>Risk assesmemt form</title>
        <link href="css/style_cic.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/collection.js"></script>
        <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css"/>
        <script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
        <link rel="STYLESHEET" type="text/css" href="style/pwdwidget.css"/>
        <script src="scripts/pwdwidget.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../themes/base/jquery.ui.all.css">
        <script src="js/jquery-1.9.1.js"></script>
        <script src="js/jquery.ui.core.js"></script>
        <script src="js/jquery.ui.widget.js"></script>
        <script src="js/jquery.ui.datepicker.js"></script>
        <link rel="stylesheet" href="demos.css" />
        <script>
         /*   $(function () {
                $("#datepicker").datepicker({
                    altField: "#alternate",
                    numberOfMonths: 3,
                    maxDate: "0M 0D",
                    changeMonth: true,
                    changeYear: true,
                    yearRange: "c-133:c+0",
                    showAnim: "slideDown",
                    altFormat: "DD, d MM, yy"
                });
            });*/
        </script>

        <!--[if IE]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <!--[if IE 6]>
        <script src="js/belatedPNG.js"></script>
        <script>
            DD_belatedPNG.fix('*');
        </script>
        <![endif]-->
    </head>

    <body>
        <div id="wrap">

            <nav id="mainnav">

                <h1 id="textlogo">
                    <?php echo $_SESSION['comp_name']; ?> <span>Portal</span>
                </h1>
                <ul>
                    <li><a href="../index.php">Home</a></li>
                </ul>
            </nav>
            <section id="content" class="normalpage">
                <section id="page">

                    <header class="subhead">
                        <h2>Risk Assessment Form</h2>
                    </header>


                    <article class="post" style="min-height:350px;">
                        <section id="introcolmn">
                            <!-- Form Code Start -->
                            <div id='fg_membersite'>
                                <table border="0" cellpadding="5px" cellspacing="1px" width="100%" align="center">
                                    <tbody>
                                        <tr style="background-color:#FFF">
                                            <td>
                                                <div id="overlay" align="left">
                                                    <table width="100%" border="0">
                                                        <tr>
                                                            <td>
                                                                <div id="overlay" align="left">
                                                                    <br>

                                                                    <form method="post"
                                                                          action="scripts/saveanswers.php?id=<?=$_GET[id]; ?>"
                                                                          enctype="multipart/form-data"
                                                                          style="background-color:#FFF">
                                                                        <br>
                                                                        <table id="mytable" width="100%">


                                                                            <tr style="background-color:#FFF">
                                                                                <td width="14%" align="left" class="formsBodyText"
                                                                                    style="padding-left:5px">&nbsp;</td>
                                                                                <td width="84%" align="left"
                                                                                    style="padding-left:5px" colspan="2">&nbsp;</td>

                                                                            </tr>
                                                                            <?php
                                                                            # get categories from db
                                                                            $sql = "SELECT label, description, autoid FROM question  ORDER BY  autoid ASC";

                                                                            $result = ibase_query($Db_conn, $sql);

                                                                            while ($row = ibase_fetch_row($result)) {
                                                                                ?>
                                                                                <tr bgcolor="#FFFFFF">
                                                                                    <td align="right"
                                                                                        style="padding-left:5px"><?= $row[0] ?>.
                                                                                    </td>
                                                                                    <td colspan="2" align="left"
                                                                                        style="padding-left:5px"><?= $row[1] ?>
                                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

                                                                                </tr>
                                                                                <?php
                                                                                # get answers db
                                                                                $asql = "SELECT tag,description,points,autoid FROM answers where questionid=$row[2]  ORDER BY  tag ASC";

                                                                                $aresult = ibase_query($Db_conn, $asql);

                                                                                while ($arow = ibase_fetch_row($aresult)) {
                                                                                    ?>
                                                                                    <tr bgcolor="#FFFFFF">
                                                                                        <td align="right" style="padding-left:5px">
                                                                                            &nbsp;</td>
                                                                                        <td colspan="2" align="left"
                                                                                            style="padding-left:5px"><?= $arow[0] ?>
                                                                                            .&nbsp;<?= $arow[1] ?>
                                                                                            .......<?= $arow[2] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                            <input type="radio"
                                                                                                   name="quest<?= $row[2] ?>"
                                                                                                   id="radio[]"
                                                                                                   value="<?= $arow[2] ?>">
                                                                                            <label for="radio"></label>
                                                                                        </td>

                                                                                    </tr>
                                                                                    
                                                                                    <?
                                                                                }
                                                                            }
                                                                            ?>
                                                                            <tr>
                                                                                <td colspan="3">&nbsp;</td>
                                                                            </tr>
                                                                            <tr class="formsWhiteBg">
                                                                                <td align="left" class="formsBodyText"
                                                                                    style="padding-left:5px">&nbsp;</td>
                                                                                <td align="center" class="formsBodyText">&nbsp;</td>
                                                                                <td style="padding-left:5px" align="left"><input
                                                                                        name="msubmit" type="submit"
                                                                                        class="button-link" id="msubmit"
                                                                                        value="Submit Assement" width="auto">
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </form>
                                                                    </
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>

                                                            </td>
                                                        </tr>
                                                    </table>

                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                        </tr>

                                    </tbody>
                                </table>


                        </section>
                        <div class="clear"></div>
                    </article>


                </section>
            </section>
        </div>

        <footer>

            <div id="bottom">
                <a href="#">Home</a> | <a href="#">About Us</a> | <a href="#">Contact Us</a> |<a href="#"> Support</a> | <a
                    href="#">Products</a> | <a href="#">Services</a>

                <div class="clear"></div>
            </div>
            <div id="credits">
                Powered by <a href="http://www.wizglobal.co.ke" target="_blank"> wizGlobal Kenya</div>
        </footer>

    </body>
</html>
