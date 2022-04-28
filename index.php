<?php
    $regexp = "/^[a-fA-F0-9]{0,32}$/";
    $command = "rcrack . -h [HASH]";

    $hash = isset($_POST['hasjiesh']) ? trim($_POST['hasjiesh']) : false;
    if (!preg_match($regexp, $hash)) {
        $error = true;
    }

    if ($hash && !$error) {
        chdir("/opt/rcrack");
        exec(strtr($command, ["[HASH]" => $hash]), $output);
    }
?>



<html>
    <head>
        <title>Crack-o-matic</title>
    </head>
    <body>
        <h1>Crack-o-matic</h1>
        <form method="POST">
            <input name="hasjiesh" value="<?= htmlspecialchars($hash)?>"/>
            <button type="submit">Crack</button>
        </form>


        <?php
        if ($error)  { ?>
            <h2>Invalid hash format</h2>
        <?php }  ?>
        <?php if ($output) { ?>
            <h2>Output</h2>
            <pre><?= join("\n", $output) ?></pre>

        <?php }?>
    </body>
</html>