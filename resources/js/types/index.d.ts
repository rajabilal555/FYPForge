export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
}

export type Student = {
    id: number;
    name: string;
    email: string;
    registration_no: string;
    email_verified_at: string;
};

export type Advisor = {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
};

export type PaginationLinks = {
    url?: string,
    label: string,
    active: boolean,
};

export type PaginatedData<T> = {
    data: T[],
    links: PaginationLinks[],
};

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>
> = T & {
    auth: {
        user: User;
    };
};
