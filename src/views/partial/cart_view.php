<div id="cart">

    <h2>Koszyk</h2>

    <table>
        <thead>
        <tr>
            <th>Mini</th>
            <th>Ilość</th>
        </tr>
        </thead>

        <tbody>
        <form action="cart/clear" method="post" class="inline">
            <?php if (!empty($cart)): ?>
                <?php foreach ($cart as $id => $foto): ?>
                    <tr>
                        <td>
                            <a href="pokaz?id=<?= $id ?>"><img src="static/images/miniatures/<?=$foto['name']?>" alt="foto" class="big"></a>
                        </td>
                        <td>
                            <input type="hidden" name="idd" value="<?= $id ?>"/>
                            <input type="checkbox" name="id[]" value="<?= $id ?>"/>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php else: ?>
                <tr>
                    <td colspan="2">Brak produktów w koszyku</td>
                </tr>
            <?php endif ?>
            </tbody>

            <tfoot>
            <tr>
                <td>Łącznie pozycji: <?= count($cart) ?></td>
                <td>
                    <input type="submit" value="Usuń wybrane" name="clear_cart"/>
                </td>
            </tr>
            </tfoot>
        </form>
    </table>
    <div>
        <a href="foto" class="cancel">&laquo; Wróć</a>
    </div>
</div>
