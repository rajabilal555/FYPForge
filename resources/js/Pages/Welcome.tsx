import {Link, Head} from '@inertiajs/react';
import {PageProps} from '@/types';
import {toast, ToastContainer} from "react-toastify";
import 'react-toastify/dist/ReactToastify.css';

export default function Welcome({auth, laravelVersion, phpVersion}: PageProps<{
    laravelVersion: string,
    phpVersion: string
}>) {
    const notify = () => toast('Work in Progress', {type: "warning",});

    return (
        <>
            <Head title="Welcome"/>
            <div
                className="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
                <div
                    className=" mx-auto p-6 lg:p-8">
                    <h1 className="text-3xl font-semibold text-center mb-6">
                        Welcome to the FYP Management Portal
                    </h1>
                    <div className="space-x-8 text-center flex align-middle justify-center">
                        <button onClick={notify}
                                className="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-full inline-block  text-lg">
                            Student Login
                        </button>
                        <button onClick={notify}
                                className="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-full inline-block  text-lg">
                            Advisor Login
                        </button>
                        <Link href={route('staff.login')}
                              className="bg-purple-500 hover:bg-purple-600 text-white py-2 px-4 rounded-full inline-block text-lg">
                            Coordinator/Staff Login
                        </Link>
                    </div>
                </div>
                <ToastContainer/>
            </div>

            <style>{`
                .bg-dots-darker {
                    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
                }
                @media (prefers-color-scheme: dark) {
                    .dark\\:bg-dots-lighter {
                        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
                    }
                }
            `}</style>
        </>
    );
}
