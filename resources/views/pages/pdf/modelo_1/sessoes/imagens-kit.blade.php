<div class="body">
    <table style="text-align: center">
        <tr>
            <td>
                <div>
                    {{--                    <img src="<?= $produto['logo_inversor'] ?>" width="170"/>--}}
                    <img src="{{ ltrim($imagens[$kit->marca_inversor]['logo'], '/') }}" width="150"/>
                    <br><br><span style="font-size:12px">Inversor</span>
                </div>
            </td>
            <td>
                <div>
                    {{--                <img src = "<?= $produto['img_painel'] ?>" width="170"/><br>--}}
                    <img src="{{ ltrim($imagens[$kit->marca_painel]['logo'], '/') }}" width="150"/>
                    <br><br><span style="font-size:12px">Painéis</span>
                </div>
            </td>
        </tr>
    </table>
</div>
