<?php
namespace WP;

class SendComment
{
    public function __construct()
    {
        $this->init();
    }

    private function init()
    {
        $this->registerRoutes();
    }

    private function registerRoutes()
    {
        $this->routeSendComment();
    }

    private function routeSendComment()
    {
        add_action('rest_api_init', function () {
            register_rest_route('v1', '/comments', [
                'methods' => \WP_REST_Server::CREATABLE,
                'permission_callback' => function () {
                    return true;
                },
                'callback' => function (\WP_REST_Request $request) {
                    $postId = $request->get_param('post-id');
                    $firstName = $request->get_param('first-name');
                    $lastName = $request->get_param('last-name');
                    $email = $request->get_param('email');
                    $message = $request->get_param('message');
                    $honeypot1 = $request->get_param('topfhonig1');
                    $honeypot2 = $request->get_param('topfhonig2');
                    $honeypot3 = $request->get_param('topfhonig3');

                    if (
                        (isset($postId) && ($postId == '' || !is_numeric($postId))) ||
                        (isset($firstName) && $firstName == '') ||
                        (isset($lastName) && $lastName == '') ||
                        (isset($email) && $email == '') ||
                        (isset($message) && $message == '')
                    ) {
                        return $this->error();
                    }

                    if (
                        isset($honeypot1) &&
                        $honeypot1 == '' &&
                        isset($honeypot2) &&
                        $honeypot2 == '' &&
                        isset($honeypot3) &&
                        $honeypot3 == ''
                    ) {
                        // add comment
                        $comment_args = [
                            'comment_post_ID' => $postId,
                            'comment_author' => $firstName . ' ' . $lastName,
                            'comment_author_email' => $email,
                            'comment_author_url' => null,
                            'comment_content' => $message,
                            'comment_type' => '',
                            'comment_parent' => 0
                        ];

                        $return = wp_new_comment($comment_args, true);

                        if (is_wp_error($return)) {
                            return $this->error($return->get_error_message());
                        }

                        // response
                        return new \WP_REST_Response(
                            [
                                'success' => true,
                                'message' => 'success',
                                'public_message' => 'Kommentar erfolgreich abgeschickt!'
                            ],
                            200
                        );
                    } else {
                        return $this->error();
                    }
                }
            ]);
        });
    }

    private function error($message = null)
    {
        return new \WP_REST_Response(
            [
                'success' => false,
                'message' => 'error',
                'public_message' =>
                    $message !== null
                        ? $message
                        : 'Es ist ein Fehler aufgetreten. Bitte versuchen Sie erneut.'
            ],
            400
        );
    }
}
