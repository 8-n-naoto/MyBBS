'use-strict';
{
    window.onload = function () {
        var tableElem = document.getElementById('exel_table');
        var rowElems = tableElem.rows;
        var exec = Number(prompt('何回仕込みますか？（数値のみで入力してください）'));
        for (i = 1, len = rowElems.length; i < len; i++) {
            //単位を先に取得
            //材料の単位
            var ingredient_unit = rowElems[i].cells[4].innerText;
            //ロットの単位
            var lot_unit = rowElems[i].cells[3].innerText;
            //計算結果（端数きり捨て）
            rowElems[i].cells[4].innerText =
                `${rowElems[i].cells[1].innerText * exec % rowElems[i].cells[2].innerText}${rowElems[i].cells[4].innerText}`;
            //計算結果（余り算出）
            rowElems[i].cells[3].innerText =
                `${parseInt(rowElems[i].cells[1].innerText * exec / rowElems[i].cells[2].innerText)}${rowElems[i].cells[3].innerText}`;

            //必要発注数
            //数値化する
            var n = Number(rowElems[i].cells[1].innerText * exec % rowElems[i].cells[2].innerText);
            if (n === 0) {
                //無ければそのまま
                rowElems[i].cells[5].innerText = rowElems[i].cells[3].innerText;
            } else {
                //端数があれば発注数を+1する
                rowElems[i].cells[5].innerText =
                    `${parseInt(Number(parseInt(rowElems[i].cells[1].innerText * exec / rowElems[i].cells[2].innerText)) + 1)}${lot_unit} `;
            }

            //その他単位つける必要があるもの
            //分量
            rowElems[i].cells[1].innerText = `${rowElems[i].cells[1].innerText}${ingredient_unit}`;
            //最低ロット分量
            rowElems[i].cells[2].innerText = `${rowElems[i].cells[2].innerText}${ingredient_unit}`;
        }
        document.getElementById('count').textContent = `：${exec}回分`;
    }
}
