@extends('layouts.admin')

@push('css')
    <style>
        .text-focus-in {
            -webkit-animation: text-focus-in 1s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;
            animation: text-focus-in 1s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;
        }

        .tracking-out-contract-bck {
            -webkit-animation: tracking-out-contract-bck 0.8s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;
            animation: tracking-out-contract-bck 0.8s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;
        }

        /* ----------------------------------------------
                                                 * Generated by Animista on 2024-3-13 11:52:32
                                                 * Licensed under FreeBSD License.
                                                 * See http://animista.net/license for more info.
                                                 * w: http://animista.net, t: @cssanimista
                                                 * ---------------------------------------------- */

        /**
                                                 * ----------------------------------------
                                                 * animation text-focus-in
                                                 * ----------------------------------------
                                                 */
        @-webkit-keyframes text-focus-in {
            0% {
                -webkit-filter: blur(12px);
                filter: blur(12px);
                opacity: 0;
            }

            100% {
                -webkit-filter: blur(0px);
                filter: blur(0px);
                opacity: 1;
            }
        }

        @keyframes text-focus-in {
            0% {
                -webkit-filter: blur(12px);
                filter: blur(12px);
                opacity: 0;
            }

            100% {
                -webkit-filter: blur(0px);
                filter: blur(0px);
                opacity: 1;
            }
        }

        /* ----------------------------------------------
                             * Generated by Animista on 2024-3-14 8:35:28
                             * Licensed under FreeBSD License.
                             * See http://animista.net/license for more info.
                             * w: http://animista.net, t: @cssanimista
                             * ---------------------------------------------- */

        /**
                             * ----------------------------------------
                             * animation tracking-out-contract-bck
                             * ----------------------------------------
                             */
        @-webkit-keyframes tracking-out-contract-bck {
            0% {
                -webkit-transform: translateZ(0);
                transform: translateZ(0);
                opacity: 1;
            }

            60% {
                opacity: 1;
            }

            100% {
                letter-spacing: -0.5em;
                -webkit-transform: translateZ(-500px);
                transform: translateZ(-500px);
                opacity: 0;
            }
        }

        @keyframes tracking-out-contract-bck {
            0% {
                -webkit-transform: translateZ(0);
                transform: translateZ(0);
                opacity: 1;
            }

            60% {
                opacity: 1;
            }

            100% {
                letter-spacing: -0.5em;
                -webkit-transform: translateZ(-500px);
                transform: translateZ(-500px);
                opacity: 0;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container my-4">
        <div class="row pt-5">
            <div class="col">
                <div class="shadow p-3 mb-5 bg-body-tertiary rounded-4">
                    @livewire('main.index')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var popoverElement = document.getElementById('popoverElement');
            var popover = new bootstrap.Popover(popoverElement);
            
            popover.show();
            
            setTimeout(() => {
                popover.hide();
            }, 15000);
        });
    </script>
@endpush
