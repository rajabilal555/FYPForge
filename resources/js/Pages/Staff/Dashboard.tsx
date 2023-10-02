import AuthenticatedLayout from "@/Layouts/StaffAuthenticatedLayout";
import { Head } from "@inertiajs/react";
import { PageProps } from "@/types";

export default function Dashboard({ auth }: PageProps) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Staff Dashboard
                </h2>
            }
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="grid grid-rows-2-4  p-4 text-black ">
                        <div className="grid grid-cols-4  gap-5">
                            <section className="mb-4 p-4 bg-white h-28">
                                <h2 className="text-l font-bold">
                                    Total Students
                                </h2>
                                <p className="text-2xl font-bold">400</p>
                                <h3>some text like that</h3>
                            </section>
                            <section className="mb-4 p-4 bg-white">
                                <h2 className="text-l font-bold">
                                    Total Advisors
                                </h2>
                                <p className="text-2xl font-bold">15</p>
                                <h3>some text like that</h3>
                            </section>
                            <section className="mb-4 p-4 bg-white">
                                <h2 className="text-l font-bold">
                                    Slots available
                                </h2>
                                <p className="text-2xl font-bold">24</p>
                                <h3>some text like that</h3>
                            </section>
                            <section className="mb-4 p-4 bg-white">
                                <h2 className="text-l font-bold">
                                    Total Student Groups
                                </h2>
                                <p className="text-2xl font-bold">45</p>
                                <h3>some text like that</h3>
                            </section>
                        </div>
                        <div className="grid grid-cols-2  gap-8">
                            <section className="mb-4 p-4 ml-8 bg-white h-96">
                                <h2 className="text-xl font-bold">
                                    Open Advisors
                                </h2>
                                <p className="">Ads with posts</p>
                                <div className="flex justify-between gap-1">
                                    <div className="flex gap-3">
                                        <div className="tag">FF</div>
                                        <div>Olivi Martin</div>
                                    </div>
                                    <div>
                                        <div className="">2 Slots</div>
                                    </div>
                                </div>
                            </section>
                            <section className="mb-4 p-4 mr-8 bg-white ">
                                <h2 className="text-xl font-bold">
                                    Recent Activity
                                </h2>
                                <ul>
                                    <li>Olivia Martin</li>
                                    <li>Jackson Las</li>
                                    <li>Isabella Nguyen</li>
                                    <li>Wiliam Kim</li>
                                    <li>Sofia Davis</li>
                                </ul>
                            </section>
                        </div>
                    </div>
                    {/* <div className="grid grid-cols-2">
                        <div className="grid grid-cols-2 h-80 w-110 mt-10 ">
                            <div className="shadow-md"></div>
                            <div className="shadow-md"></div>
                            <div className="shadow-md"></div>
                            <div className="shadow-md"></div>
                        </div>
                        <div className="grid grid-cols-2 h-80 w-160 mt-10 ">
                            <div className="shadow-md"></div>
                            <div className="shadow-md"></div>
                        </div>
                    </div> */}
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
