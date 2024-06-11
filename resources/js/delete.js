$(document).ready(function() {
    // CSRFトークンをmetaタグから取得
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    // 削除ボタンがクリックされたときの処理
    $(document).on('click', '.delete-button', function() {
        // 削除対象の商品IDを取得
        var productId = $(this).data('id');

        // 確認メッセージを表示し、削除を実行するかどうかユーザーに確認
        if (confirm('この商品を削除しますか？')) {
            // 削除リクエストを送信
            $.ajax({
                url: '/product/' + productId,
                type: 'DELETE',
                data: {
                    // CSRFトークンをリクエストに含める
                    _token: csrfToken
                },
                success: function(response) {
                    // 成功した場合、削除された商品を画面から非表示にする
                    window.location.href = '/index';
                },
                error: function(xhr, status, error) {
                    // エラーが発生した場合、エラーメッセージを表示
                    alert('商品の削除中にエラーが発生しました。');
                    console.error(xhr.responseText);
                }
            });
        }
    });
});
