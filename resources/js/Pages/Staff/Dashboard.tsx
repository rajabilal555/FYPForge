import AuthenticatedLayout from '@/Layouts/StaffAuthenticatedLayout';
import {Head} from '@inertiajs/react';
import {PageProps} from '@/types';

export default function Dashboard({auth}: PageProps) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Staff Dashboard</h2>}
        >
            <Head title="Dashboard"/>

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">You're logged in!</div>
                    </div>

                    <div className="grid grid-cols-2">
                        <div className="grid grid-cols-2 h-80 w-110 mt-10 ">
                            <div className='shadow-md'></div>
                            <div className='shadow-md'></div>
                            <div className='shadow-md'></div>
                            <div className='shadow-md'></div>
                        </div>
                        <div className="grid grid-cols-2 h-80 w-160 mt-10 ">
                            <div className='shadow-md'></div>
                            <div className='shadow-md'></div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
